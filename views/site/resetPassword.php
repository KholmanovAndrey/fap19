<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Сброс пароля';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-reset-password padding">
    <div class="container">
        <div class="title">
            <h1><?= Html::encode($this->title) ?></h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-lg-5 alert alert-warning">Пожалуйста, выберите новый пароль:</div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>