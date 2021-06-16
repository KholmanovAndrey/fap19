<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<?php if (!empty($session['cart'])): ?>
    <section class="cart-ones padding">
        <div class="container">
            <div class="title">
                <h1 class="title__header">Оформление заказов</h1>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <?php if (Yii::$app->session->getFlash('error')) : ?>
                <div class="alert alert-danger alert-dismissable" role="alert">
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif ?>

            <?php $form = ActiveForm::begin(); ?>
            <h2 class="cart-ones__h2">Контактрая информация</h2>
            <?= $form->field($order, 'shopper_id')->hiddenInput(['value' => $user->id])->label(false); ?>
            <?= $form->field($order, 'name')->input('text', ['value' => $user->fio, 'required'=>true]); ?>
            <?= $form->field($order, 'email')->input('email', ['value' => $user->email, 'required'=>true]); ?>
            <?= $form->field($order, 'phone')->input('phone', ['value' => $user->phone, 'required'=>true]); ?>
            <?= $form->field($order, 'address')->input('address', ['value' => $user->adress, 'required'=>true]); ?>

            <div id="delivery">
                <h2 class="cart-ones__h2">Доставка</h2>
                <?
                foreach ($delivery as $deli) {
                    $delivery_arr[$deli->id] = [0 => $deli->name, 1 => $deli->description];
                }
                ?>
                <?=
                $form->field($order, 'delivery_id')
                    ->radioList(
                        $delivery_arr,
                        [
                            'item' => function($index, $label, $name, $checked, $value) {

                                $return = '<label class="modal-radio">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                                $return .= '<i></i>';
                                $return .= ' <b>' . ucwords($label[0]) . '</b><br/>';
                                $return .= ' <span>' . ucwords($label[1]) . '</span>';
                                $return .= '</label><br/>';

                                return $return;
                            }
                        ]
                    )
                    ->label(false);
                ?>
            </div>

            <div id="payment">
                <h2 class="cart-ones__h2">Оплата</h2>
                <?
                foreach ($payments as $payment) {
                    $payments_arr[$payment->id] = [0 => $payment->name, 1 => $payment->description];
                }
                ?>
                <?=
                $form->field($order, 'payment_id')
                    ->radioList(
                        $payments_arr,
                        [
                            'item' => function($index, $label, $name, $checked, $value) {

                                $return = '<label class="modal-radio payment-radio-' . $value . '">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3"';
                                if ($index === 1) {
                                    $return .= 'checked';
                                }
                                $return .= '>';
                                $return .= '<i></i>';
                                $return .= ' <b>' . ucwords($label[0]) . '</b><br/>';
                                $return .= ' <span>' . ucwords($label[1]) . '</span>';
                                $return .= '</label><br/>';

                                return $return;
                            }
                        ]
                    )
                    ->label(false);
                ?>
            </div>

            <h2 class="cart-ones__h2">Состав заказа</h2>
            <div class="cart-one">
                <div class="cart-one__col cart-one__col_header cart-one__col_1">Картинка</div>
                <div class="cart-one__col cart-one__col_header cart-one__col_2">Наименование</div>
                <div class="cart-one__col cart-one__col_header cart-one__col_3">Кол-во</div>
                <div class="cart-one__col cart-one__col_header cart-one__col_3">Цена, рублей</div>
                <div class="cart-one__col cart-one__col_header cart-one__col_4"></div>
            </div>
            <?php foreach ($session['cart'] as $id => $item): ?>
                <div class="cart-one">
                    <div class="cart-one__col cart-one__col_1"><img class="cart-one__img" src="<?php
                        $url = explode(',', $item['img']);
                        echo $url[0];
                        ?>" alt=""></div>
                    <div class="cart-one__col cart-one__col_2"><?= $item['name'] ?></div>
                    <div class="cart-one__col cart-one__col_3"><?= $item['qty'] ?></div>
                    <div class="cart-one__col cart-one__col_3"><?= $item['price'] ?></div>
                    <div class="cart-one__col cart-one__col_4 cart-one__col_del" data-id="<?= $id ?>"></div>
                </div>
            <?php endforeach ?>
            <div class="cart-one">
                <div class="cart-one__col cart-one__col_1"></div>
                <div class="cart-one__col cart-one__col_2 cart-one__col_right">Итого:</div>
                <div class="cart-one__col cart-one__col_3"><?= $session['cart.qty'] ?></div>
                <div class="cart-one__col cart-one__col_3"><?= $session['cart.sum'] ?></div>
                <div class="cart-one__col cart-one__col_4"></div>
            </div>
            <div class="cart-one">
                <a href="<?= \yii\helpers\Url::to(['cart/index']) ?>" class="btn btn-warning">Вернуться в корзину</a>
            </div>

            <h2 class="cart-ones__h2">Комментарий к заказу</h2>
            <?= $form->field($order, 'comment')
                ->textarea(['rows' => '6', 'placeholder' => "Опишите ваши пожелания при оформлений заказа"])
                ->label(false);?>

            <?= Html::submitButton('Завершить оформление заказа', ['class' => 'cart-ones__btn btn btn-warning']); ?>
            <?php $form = ActiveForm::end(); ?>
        </div>
    </section>
<?php else : ?>
    <div class="orders padding">
        <div class="container">
            <div class="title">
                <h2 class="title__header">Оформление заказов</h2>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <?php if (Yii::$app->session->getFlash('success')) : ?>
                <div class="alert alert-success alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php else : ?>
                <h3>Нет оформленных заказов</h3>
            <?php endif ?>
        </div>
    </div>
<?php endif ?>