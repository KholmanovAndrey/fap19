<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">
    <div class="container">
        <div class="title">
            <h1 class="title__header">Просмотр заказа № <?= Html::encode($model->id) . ' (' . Html::encode($this->title) ?>)</h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>

        <?= \yii\widgets\Breadcrumbs::widget([
            'itemTemplate' => "<li class=\"breadcrumb__list\"><i>{link}</i> <i class=\"fas fa-long-arrow-alt-right\"></i></li>\n",
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <p>
            <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'created_at',
                'updated_at',
                'qty',
                'sum',
                [
                    'attribute' => 'status',
                    'value' => function($data){
                        if ((int)$data->status === 0) {
                            return '<span class="btn btn-primary">Новый</span>';
                        } elseif ((int)$data->status === 1) {
                            return '<span class="btn btn-warning">Принят</span>';
                        } elseif ((int)$data->status === 2) {
                            return '<span class="btn btn-success">Выполнен</span>';
                        } elseif ((int)$data->status === 3) {
                            return '<span class="btn btn-danger">Отменен</span>';
                        }
                    },
                    'format' => 'raw',
                ],
                'name',
                'email:email',
                'phone',
                'address',
            ],
        ]) ?>

        <?php $items = $model->orderItems; ?>

        <div class="cartOne">
            <div class="cart__flex">
                <div class="cart__elem cart__elem_name">Наименование</div>
                <div class="cart__elem cart__elem_qty">Кол-во</div>
                <div class="cart__elem cart__elem_price">Цена, рублей</div>
                <div class="cart__elem cart__elem_price">Сумма, рублей</div>
            </div>
            <div class="cartBox">
                <div class="cartItems">
                    <?php foreach($items as $item): ?>
                        <div class="cart__flex">
                            <div class="cart__elem cart__elem_name">
                                <a href="<?= Url::to(['/product/view', 'id' => $item->product_id]) ?>"><?= $item->name ?></a>
                            </div>
                            <div class="cart__elem cart__elem_qty"><?= $item->qty_item ?></div>
                            <div class="cart__elem cart__elem_price"><?= $item->price ?></div>
                            <div class="cart__elem cart__elem_price"><?= $item->sum_item ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
