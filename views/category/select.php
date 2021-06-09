<?= \app\components\CategoryWidget::widget(['tpl' => 'select',
    'categoryID' => $id,
    'categoryCurrent' => $id,
    'cache' => false]) ?>