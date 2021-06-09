<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_product') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'alias') ?>

    <?= $form->field($model, 'condition') ?>

    <?php // echo $form->field($model, 'bodywork') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'engine') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'l_r') ?>

    <?php // echo $form->field($model, 'f_r') ?>

    <?php // echo $form->field($model, 'u_d') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'noticy') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'authenticity') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'publication') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
