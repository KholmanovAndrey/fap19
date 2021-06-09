<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            //'alias',
            //'image',
            //'description:ntext',
            //'text:ntext',
            //'position',
            //'publication',

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
