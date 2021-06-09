<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запчасти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <div class="container padding">
        <div class="title">
            <h1 class="title__header"><?= Html::encode($this->title) ?></h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>

        <?= \yii\widgets\Breadcrumbs::widget([
            'itemTemplate' => "<li class=\"breadcrumb__list\"><i>{link}</i> <i class=\"fas fa-long-arrow-alt-right\"></i></li>\n",
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('Новая запчасть', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                //'id_product',
                'name',
                //'alias',
                'condition',
                //'bodywork',
                //'number',
                //'engine',
                //'age',
                //'l_r',
                //'f_r',
                //'u_d',
                //'color',
                //'noticy:ntext',
                'price',
                //'image:ntext',
                //'status',
                //'authenticity',
                //'position',
                //'publication',
                [
                    'attribute' => 'publication',
                    'value' => function($data){
                        return !$data->publication ?
                            '<span class="text-danger">Отключена</span>' :
                            '<span class="text-success">Активна</span>';
                    },
                    'format' => 'raw',
                ],
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
