<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login padding">
    <div class="container">
        <div class="title">
            <h1><?= Html::encode($this->title) ?></h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-lg-5 alert alert-warning">Пожалуйста, заполните следующие поля для входа:</div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div>{input}</div>\n<div>{error}</div>",
                        'labelOptions' => ['class' => 'control-label'],
                    ],
                ]); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div>{input} {label}</div>\n<div>{error}</div>",
                ]) ?>
                <div style="text-align: right">
                    <?= Html::a('Регистрация',
                        ['signup']) ?> |
                    <?= Html::a('Забыли пароль?',
                        ['request-password-reset']) ?>
                </div>
                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Вход', ['class' => 'btn btn-warning', 'name' => 'login-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>
