<?php

use yii\helpers\Html;

?>
<?php if (!empty($category)): ?>
    <section class="products padding">
        <div class="container">
            <div class="title">
                <h1 class="title__header"><?= (!empty($parent_category)) ? $parent_category->name . ' / ' : '' ?><?= $category->name ?></h1>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <div class="products__flex">
                <?php
                if (!empty($products)):
                    foreach ($products as $product): ?>
                        <div class="product">
                            <div class="product__box">
                                <div class="product__image">
                                    <?php if ($product->image != Null):
                                        $image = explode(',', $product->image) ?>
                                        <?= Html::img($image[0], ['alt' => $product->alias, 'class' => 'product__img']); ?>
                                    <?php else: ?>
                                        <?= Html::img('@web/img/product/no-image.png', ['alt' => $product->alias, 'class' => 'product__img']); ?>
                                    <?php endif ?>
                                </div>
                                <h2 class="product__name"><?= $product->name ?></h2>
                                <p class="product__manufacturer"><i class="fas fa-car"></i>
                                    <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category[0]->id]) ?>"
                                       class="product__link"><?= $product->category[0]->name ?></a>
                                    /
                                    <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category[1]->id]) ?>"
                                       class="product__link"><?= $product->category[1]->name ?></a></p>
                                <p class="product__price"><i class="fas fa-tag"></i> <?= $product->price ?> <i
                                            class="fas fa-ruble-sign"></i>
                                </p>
                                <div class="product__buttons">
                                    <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product->id]) ?>"
                                       class="btn btn-warning">Подробнее <i class="fas fa-long-arrow-alt-right"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <h3>Здесь товаров нет</h3>
                <?php endif ?>
            </div>
        </div>
    </section>
    <?php echo \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
<?php else: ?>
    <div class="products padding">
        <div class="container">
            <div class="title">
                <h2 class="title__header">Поиск по
                    запросу: <?= (!empty($markaCategory)) ? $markaCategory->name . ' / ' : '' ?><?php
                    ?><?= (!empty($modelCategory)) ? $modelCategory->name . ' / ' : '' ?><?php
                    ?> <?= Html::encode($part) ?></h2>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <h3>По данному запросу ничего не найдено</h3>
        </div>
    </div>
<?php endif ?>
