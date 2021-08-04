<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TransportCompany */

$this->title = 'Update Transport Company: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Transport Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transport-company-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
