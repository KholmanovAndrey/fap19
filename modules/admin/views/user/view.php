<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */

$this->title ='Пользователь ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div class="container padding">
        <div class="title">
            <h1 class="title__header"><?= Html::encode($this->title) ?></h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>

        <?= \yii\widgets\Breadcrumbs::widget([
            'itemTemplate' => "<li class=\"breadcrumb__list\"><i>{link}</i> <i class=\"fas fa-long-arrow-alt-right\"></i></li>\n",
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <p>
            <?= Html::a('Редактировать данные', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                'username',
                //'auth_key',
                //'password_hash',
                //'password_reset_token',
                'fio',
                'email:email',
                'phone',
                'adress',
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
                [
                    'attribute' => 'created_at',
                    'value' => function($data){
                        return date("Y-m-d H:i:s", $data->created_at);
                    },
                    'format' => 'raw',
                ],
                //'updated_at',
                [
                    'attribute' => 'updated_at',
                    'value' => function($data){
                        return date("Y-m-d H:i:s", $data->updated_at);
                    },
                    'format' => 'raw',
                ],
            ],
        ]) ?>
    </div>
</div>
