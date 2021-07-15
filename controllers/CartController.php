<?php
/**
 * Created by PhpStorm.
 * User: Программист
 * Date: 15.03.2019
 * Time: 10:45
 */

namespace app\controllers;

use app\models\Delivery;
use app\models\Payments;
use app\models\Product;
use app\models\Cart;
use app\models\Order;
use app\models\OrderItems;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;

class CartController extends AppController {
    private $orderBy = 'id DESC';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['order', 'history', 'accept', 'ispaid', 'payment'],
                'rules' => [
                    [
                        'actions' => ['order', 'ispaid', 'payment'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['accept'],
                        'allow' => true,
                        'roles' => ['canAcceptOrders'],
                    ],
                    [
                        'actions' => ['history'],
                        'allow' => true,
                        'roles' => ['canHistoryOrders'],
                    ],
                ],
            ],
        ];
    }

    public function actionGet() {
        $session = Yii::$app->session;
        $session->open();

        // проверка на работу ajax
//        if (!Yii::$app->request->is){
//            return $this->redirect(Yii::$app->request->referrer);
//        }

        // убираем шаблон
        $this->layout = false;

        return $this->render('ajax', compact('session'));
    }

    public function actionAdd($id, $qty) {
        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }

        $qty = !(int)$qty ? 1 : $qty;

        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->addToCart($product, $qty);

        // проверка на работу ajax
        if (!Yii::$app->request->isAjax){
            return $this->redirect(Yii::$app->request->referrer);
        }

        // убираем шаблон
        $this->layout = false;

        return $this->render('ajax', compact('session'));
    }

    public function actionDelete($id, $page = 'ajax') {
        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->recalc($id);

        // проверка на работу ajax
        if (!Yii::$app->request->isAjax){
            return $this->redirect(Yii::$app->request->referrer);
        }

        // убираем шаблон
        $this->layout = false;

        return $this->render($page, compact('session'));
    }

    public function actionClear() {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');

        return $this->render('index', compact('session'));
    }

    public function actionDetails($id) {

        $order = Order::find()->with(['delivery', 'payment'])->where(['id' => (int)$id])->One();
        $details = OrderItems::find()->where(['order_id' => (int)$id])->All();

        // проверка на работу ajax
        if (!Yii::$app->request->isAjax){
            return $this->redirect(Yii::$app->request->referrer);
        }

        // убираем шаблон
        $this->layout = false;

        return $this->render('details', compact('order', 'details'));
    }

    public function actionIndex() {
        $session = Yii::$app->session;
        $session->open();

        // устанавлеваем данные мета-тегов
        $this->setMeta('Корзина заказов');

        return $this->render('index', compact('session'));
    }

    public function actionHistory() {
        $user = Yii::$app->user->identity;

        if (Yii::$app->user->can('seller')) {
            $where = ['seller_id' => $user->id];
        } else {
            $where = ['shopper_id' => $user->id];
        }

        $query = Order::find()->where($where);
        $pages = new Pagination(['totalCount' => $query->count(), 'forcePageParam' => false, 'pageSizeParam' => false]);
        $orders = $query->with('orderItems')->orderBy($this->orderBy)->offset($pages->offset)->limit($pages->limit)->all();

        // устанавлеваем данные мета-тегов
        $this->setMeta('История заказов');

        return $this->render('history', compact('orders', 'user'));
    }

    public function actionAccept($id = 0, $accept = 0) {

        if ($id !== 0 AND (int)$accept === 1) {
            $user = Yii::$app->user->identity;
            $order = Order::findOne((int)$id);
            $order->status = '1';
            $order->seller_id = $user->id;
            if ($order->save()) {
                return $this->redirect(['cart/history']);
            } else {
                var_dump($order->getErrors());
            }
        }

        $query = Order::find()->where(['status' => 1]);
        $pages = new Pagination(['totalCount' => $query->count(), 'forcePageParam' => false, 'pageSizeParam' => false]);
        $orders = $query->with('orderItems')->orderBy($this->orderBy)->offset($pages->offset)->limit($pages->limit)->all();

        // устанавлеваем данные мета-тегов
        $this->setMeta('Принять заказы');

        return $this->render('accept', compact('orders'));
    }

    public function actionOrder() {
        $session = Yii::$app->session;
        $session->open();

        $user = Yii::$app->user->identity;

        $order = new Order();
        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            $order->status = '0';
            $order->seller_id = 0;
            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);

                Yii::$app->session->setFlash('success',
                    "Ваш заказ принят. Менеджер вскоре свяжется с Вами.");

                // отправка письма клиенту
                Yii::$app->mailer->compose('order', ['session' => $session])
                    ->setFrom([Yii::$app->params['orderEmail'] => Yii::$app->params['siteName']])
                    ->setTo($order->email)
                    ->setSubject('Заказ')
                    ->send();

                // отправка письма администратору заказа
                Yii::$app->mailer->compose('order', ['session' => $session])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['siteName']])
                    ->setTo(Yii::$app->params['orderEmail'])
                    ->setSubject('Заказ')
                    ->send();

                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');

                if ($order->payment_id === '2') {
                    return $this->redirect(['cart/payment', 'id' => $order->id]);
                }

                return $this->refresh();
            } else {
                var_dump($order->getErrors());
                Yii::$app->session->setFlash('error', "Ошибка оформления заказа.");
            }
        }

        $delivery = Delivery::find()->all();
        $payments = Payments::find()->all();

        // устанавлеваем данные мета-тегов
        $this->setMeta('Оформление заказа');

        return $this->render('order', compact('session', 'order', 'user', 'delivery', 'payments'));
    }

    public function actionPayment($id) {
        $order = Order::find()->with(['delivery', 'payment'])->where(['id' => (int)$id])->One();

        return $this->render('payment', compact('order'));
    }

    public function actionIspaid() {
        $secret_seed = "A6[m(APkwXfNYEuR.cB";
        $id = $_POST['id'];
        $sum = $_POST['sum'];
        $clientid = $_POST['clientid'];
        $orderid = $_POST['orderid'];
        $key = $_POST['key'];

//        if ($key != md5 ($id.number_format($sum, 2, ".", "")
//          .$clientid.$orderid.$secret_seed)) {
////            echo "Error! Hash mismatch";
//            exit;
//        }

//        $order = Order::findOne($orderid);
//        if ($order && (int)$order->shopper_id === (int)$clientid) {
//            $order->isPaid = 1;
//            $order->save();
//        }
        $order = Order::findOne($orderid);
        $order->isPaid = 1;
        $order->save();
    }

    protected function saveOrderItems($items, $order_id){
        foreach ($items as $id => $item) {
            $orderItems = new OrderItems();
            $orderItems->order_id = $order_id;
            $orderItems->product_id = $id;
            $orderItems->name = $item['name'];
            $orderItems->price = $item['price'];
            $orderItems->qty_item = $item['qty'];
            $orderItems->sum_item = $item['qty'] * $item['price'];
            $orderItems->save();
        }
    }
}