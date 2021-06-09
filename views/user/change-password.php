<?php
/**
 * @var \App\models\User $user
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<div class="container">
    <div class="user-single padding">
        <div class="title">
            <h1 class="title__header">Сменить пароль</h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'user-form',
            'fieldConfig' => [
                'template' => "{label}\n<div>{input}</div>\n<div>{error}</div>",
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>
        <div class="form-group field-user-password_hash required has-success">
            <?= Html::label('Новый пароль', 'password', ['class' => 'password']) ?>
            <?= Html::textInput('password', '', ['class' => 'form-control', 'id' => 'password']) ?>
        </div>
        <div class="form-group field-user-password_hash required has-success">
            <?= Html::label('Повторите пароль', 'password_confirm', ['class' => 'password_confirm']) ?>
            <?= Html::textInput('password_confirm', '', ['class' => 'form-control', 'id' => 'password_confirm']) ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-warning']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>