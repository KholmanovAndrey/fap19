<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">
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
                //'parent_id',
                [
                    'attribute' => 'parent_id',
                    'value' => function($data){
                        return $data->category->name ? $data->category->name : 'нет родителя';
                    }
                ],
                'name',
                'alias',
                'logo',
                'position',
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
            ],
        ]) ?>
    </div>
</div>
