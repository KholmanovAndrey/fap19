<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Запрос сброса пароля';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-request-password-reset padding">
    <div class="container">
        <div class="title">
            <h1><?= Html::encode($this->title) ?></h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>
        <?php if (Yii::$app->session->getFlash('success') || Yii::$app->session->getFlash('error')) : ?>
            <?php if (Yii::$app->session->getFlash('success')) : ?>
                <div class="alert alert-success alert-dismissable" role="alert">
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif ?>

            <?php if (Yii::$app->session->getFlash('error')) : ?>
                <div class="alert alert-danger alert-dismissable" role="alert">
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif ?>
        <?php else : ?>
            <div class="row justify-content-md-center">
                <div class="col-lg-5 alert alert-warning">Пожалуйста, заполните ваш email. Ссылка для сброса пароля
                    будет
                    отправлена туда.
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-lg-5">

                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-warning']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        <?php endif ?>
    </div>
</div>