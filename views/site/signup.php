<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup padding">
    <div class="container">
        <div class="title">
            <h1><?= Html::encode($this->title) ?></h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-lg-5 alert alert-warning">Пожалуйста, заполните следующие поля для регистрации:</div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-warning', 'name' => 'signup-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>