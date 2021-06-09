<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_product')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'condition')->dropDownList([ "Б.у." => 'Б.у.', "Новая" => 'Новая', ]) ?>

    <?= $form->field($model, 'bodywork')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'engine')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'l_r')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'f_r')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'u_d')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noticy')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authenticity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'publication')->dropDownList([ 0 => 'Отключена', 1 => 'Активна', ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
