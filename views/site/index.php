<?php

use \yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Магазин автозапчастей в Абакане - FelixAutoParts';

?>
<?php if (!empty($last_product)): ?>
    <section class="products padding">
        <div class="container">
            <div class="title">
                <h2 class="title__header">Последние запчасти</h2>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <div class="products__flex">
                <?php foreach ($last_product as $product): ?>
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
                            <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category[0]->id]) ?>" class="product__link"><?= $product->category[0]->name ?></a>
                            / <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category[1]->id]) ?>" class="product__link"><?= $product->category[1]->name ?></a></p>
                        <p class="product__price"><i class="fas fa-tag"></i> <?= $product->price ?> <i class="fas fa-ruble-sign"></i>
                        </p>
                        <div class="product__buttons">
                            <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product->id]) ?>" class="btn btn-warning">Подробнее <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <a href="<?= \yii\helpers\Url::to(['category/index']) ?>" class="btn btn-warning products__button">Все запчасти <i class="fas fa-chevron-right"></i></a>
        </div>
    </section>
<?php endif ?>


    <div class="funfacts padding overlay">
        <div class="container funfacts__flex">
            <div class="funfact">
                <div class="funfact__icon"><i class="fas fa-smile"></i></div>
                <div class="funfact__content">
                    <p><span class="counter">550</span>+</p>
                    <h4>Счасливых клиентов</h4>
                </div>
            </div>
            <div class="funfact">
                <div class="funfact__icon"><i class="fa fa-car"></i></div>
                <div class="funfact__content">
                    <p><span class="counter">250</span>+</p>
                    <h4>Марок автомобилей</h4>
                </div>
            </div>
            <div class="funfact">
                <div class="funfact__icon"><i class="fa fa-cog"></i></div>
                <div class="funfact__content">
                    <p><span class="counter">50</span>+</p>
                    <h4>Запчастей в наличии</h4>
                </div>
            </div>
        </div>
    </div>
<?php if (!empty($about)): ?>
    <div class="about-index padding">
        <article class="container">
            <div class="title">
                <h2 class="title__header"><?= $about->name ?></h2>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <div class="about-index__flex">
                <div class="about-index__text"><?= $about->description ?></div>
                <div class="about-index__image"><?= Html::img('/web/img/article/' . $about->image, ['alt' =>
                        $about->alias]); ?>
                </div>
            </div>
        </article>
    </div>
<?php endif ?>
<?php if (!empty($last_article)): ?>
    <section class="articles padding">
        <div class="container">
            <div class="title">
                <h2 class="title__header">Советы и статьи</h2>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <div class="articles__content">
                <?php foreach ($last_article as $article): ?>
                    <article class="article">
                        <div class="article__thumb">
                            <?php if ($article->image != Null):
                                $image = explode(',', $article->image) ?>
                                <?= Html::img('/web/img/article/' . $article->image, ['alt' => $article->alias]); ?>
                            <?php else: ?>
                                <?= Html::img('/web/img/product/no-image.png', ['alt' => $article->alias]); ?>
                            <?php endif ?>
                        </div>
                        <div class="article__body">
                            <h3>
                                <a href="<?= \yii\helpers\Url::to(['article/view', 'id' => $article->id]) ?>"><?= $article->
                                    name ?></a></h3>
<!--                            <div class="article__date">25 <span class="month">янв</span></div>-->
                            <p><?= $article->description ?></p>
                            <a class="btn btn-warning"
                               href="<?= \yii\helpers\Url::to(['article/view', 'id' => $article->id]) ?>" class="btn2">Читать
                                далее <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </article>
                <?php endforeach ?>
            </div>
            <a class="btn btn-warning" href="<?= \yii\helpers\Url::to(['article/index']) ?>" class="btn">Все советы
                и статьи <i class="fa fa-long-arrow-right"></i></a>
        </div>
    </section>
<?php endif ?>