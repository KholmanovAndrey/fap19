<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
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
            <?= Html::a('Новый пользователь', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'username',
                //'auth_key',
                //'password_hash',
                //'password_reset_token',
                'email:email',
                'fio',
                //'phone',
                //'adress',
                //'status',
                [
                    'attribute' => 'status',
                    'value' => function($data){
                        return !$data->status ?
                            '<span class="text-danger">Отключен</span>' :
                            '<span class="text-success">Активен</span>';
                    },
                    'format' => 'raw',
                ],
                //'created_at',
                //'updated_at',

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
