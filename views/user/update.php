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
            <h1 class="title__header">Редактировать пользователя</h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'user-form',
            'fieldConfig' => [
                'template' => "{label}\n<div>{input}</div>\n<div>{error}</div>",
                'labelOptions' => ['class' => 'control-label'],
            ],
        ]); ?>
        <?= $form->field($user, 'fio')->textInput(['autofocus' => true]) ?>
        <?= $form->field($user, 'email')->textInput() ?>
        <?= $form->field($user, 'phone')->textInput() ?>
        <?= $form->field($user, 'adress')->textInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-warning']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>