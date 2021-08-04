<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TransportCompany */

$this->title = 'Create Transport Company';
$this->params['breadcrumbs'][] = ['label' => 'Transport Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transport-company-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
