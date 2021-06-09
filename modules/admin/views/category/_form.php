<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\modules\admin\models\Category::find()->all(), 'id', 'name')) ?>

    <div class="form-group field-category-parent_id has-success">
        <label class="control-label" for="category-parent_id">Родительская категория</label>
        <select id="category-parent_id" class="form-control" name="Category[parent_id]" aria-invalid="false">
            <option value="0">нет родительской категории</option>
            <?= \app\components\CategoryWidget::widget(['tpl' => 'select',
                'categoryID' => 0,
                'categoryCurrent' => $model->parent_id,
                'cache' => false]) ?>
        </select>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'publication')->dropDownList([ 0 => 'Отключена', 1 => 'Активна', ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
