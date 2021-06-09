<?php

use yii\helpers\Html;

$this->title = 'Импорт данных';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="import-index">
    <div class="container padding">
        <div class="title">
            <h1 class="title__header"><?= Html::encode($this->title) ?></h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>

        <?= \yii\widgets\Breadcrumbs::widget([
            'itemTemplate' => "<li class=\"breadcrumb__list\"><i>{link}</i> <i class=\"fas fa-long-arrow-alt-right\"></i></li>\n",
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?php if ($message) : ?>
            <div class="alert alert-success alert-dismissable" role="alert">
                <p>Импорт данных:</p>
                <?= $message ?>
            </div>
        <?php endif ?>

        <div class="import-index__box">
            <h2 class="import-index__h">Сброс данных</h2>
            <p class="import-index__p">
                <?= Html::a('Сброс категории', ['delete-categories'], ['class' => 'btn btn-danger']) ?>
                <?= Html::a('Сброс запчастей', ['delete-products'], ['class' => 'btn btn-danger']) ?>
            </p>
        </div>

        <div class="import-index__box">
            <h2 class="import-index__h">Импорт запчастей и категорий</h2>
            <p class="import-index__p">
                <?= Html::a('Всех данных', ['all'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>

        <div class="import-index__box">
            <h2 class="import-index__h">Импорт категорий</h2>
            <p class="import-index__p">
                <?= Html::a('Все категории', ['create-category'], ['class' => 'btn btn-warning']) ?>
            </p>
        </div>

        <div class="import-index__box">
            <h2 class="import-index__h">Импорт запчастей</h2>
            <p class="import-index__p">
                <?= Html::a('Всех запчастей', ['add-product'], ['class' => 'btn btn-info']) ?>
                <?= Html::a('Обновление запчастей', ['update-product'], ['class' => 'btn btn-info']) ?>
                <?= Html::a('Обновление цен на запчасти', ['update-price'], ['class' => 'btn btn-info']) ?>
                <?= Html::a('Обновление статуса запчастей', ['update-status'], ['class' => 'btn btn-info']) ?>
            </p>
        </div>
    </div>
</div>