<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <div class="container padding">
        <div class="title">
            <h1 class="title__header"><?= Html::encode($this->title) ?></h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>

        <?= \yii\widgets\Breadcrumbs::widget([
            'itemTemplate' => "<li class=\"breadcrumb__list\"><i>{link}</i> <i class=\"fas fa-long-arrow-alt-right\"></i></li>\n",
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

<!--        --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('Новая категория', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                //'parent_id',
                [
                    'attribute' => 'parent_id',
                    'value' => function($data){
                        return $data->category->name ? $data->category->name : 'нет родителя';
                    }
                ],
                'name',
                //'alias',
                //'logo',
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
