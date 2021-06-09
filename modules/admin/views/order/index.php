<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    <div class="container padding">

        <div class="title">
            <h1 class="title__header"><?= Html::encode($this->title) ?></h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>

        <?= \yii\widgets\Breadcrumbs::widget([
            'itemTemplate' => "<li class=\"breadcrumb__list\"><i>{link}</i> <i class=\"fas fa-long-arrow-alt-right\"></i></li>\n",
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <p><?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?></p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'created_at',
                'updated_at',
                'qty',
                'sum',
                [
                    'attribute' => 'status',
                    'value' => function ($data) {
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
                //'status',
                //'name',
                //'email:email',
                //'phone',
                //'address',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-eye"></i>', $url, ['class' => 'btn btn-dark']);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-pen"></i>', $url, ['class' => 'btn btn-dark']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-trash-alt"></i>', $url, ['class' => 'btn btn-dark']);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
