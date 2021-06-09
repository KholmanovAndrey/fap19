<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([
        '0' => 'Активен',
        '1' => 'Принят',
        '2' => 'Выполнен',
        '3' => 'Отменен',
    ]) ?>

    <?= $form->field($model, 'user_id')
        ->hiddenInput(['maxlength' => true, 'value' => $user->id])->label(false) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')
        ->hiddenInput(['maxlength' => true, 'value' => $user->email])->label(false) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
