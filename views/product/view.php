<?php

use yii\helpers\Html;

?>
<?php if (!empty($product)): ?>
    <section class="products padding">
        <div class="container">
            <div class="title">
                <h1 class="title__header"><?= $product->name ?></h1>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <div class="product-view">
                <div class="product-view__left">
                    <div class="product-view__slider">
                        <?php if ($product->image != Null) : $images = explode(',', $product->image); ?>
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php foreach ($images as $key => $image): ?>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="<?=$key?>"
                                            <?=($key === 0)? 'class="active"' : ''?>></li>
                                    <?php endforeach ?>
                                </ol>
                                <div class="carousel-inner">
                                    <?php foreach ($images as $key => $image): ?>
                                        <div class="carousel-item<?=($key === 0)? ' active"' : ''?>" data-interval="2000">
                                            <?= Html::img($image, ['class' => 'd-block w-100',
                                                'alt' => $product->alias . ' ' . $key]); ?>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        <?php else: ?>
                            <?= Html::img('@web/img/product/no-image.png', ['alt' => $product->alias]); ?>
                        <?php endif ?>
                    </div>
                    <div class="product-view__desc">
                        <p><?= $product->noticy ?></p>
                    </div>
                </div>
                <div class="product-view__right">
                    <div class="product-view__basket">
                        <div class="product-view__row">
                            <div class="product-view__col">Состояние товара ::</div>
                            <div class="product-view__col"><?= $product->condition ?></div>
                        </div>
                        <div class="product-view__row">
                            <div class="product-view__col">Наличие товара ::</div>
                            <div class="product-view__col"><?= $product->status ?></div>
                        </div>
                        <div class="product-view__row">
                            <div class="product-view__col">Цена товара ::</div>
                            <div class="product-view__col"><?= $product->price ?> <i
                                        class="fa fa-rub"></i></div>
                        </div>
                        <div class="product-view__row">
                            <div class="product-view__col">
                                <input type="number" min="1" class="product-view__input" id="qty" value="1">
                            </div>
                            <div class="product-view__col">
                                <a class="btn btn-warning add-to-cart"
                                   data-id="<?= $product->id ?>"
                                   href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id]) ?>"><i
                                            class="fa fa-shopping-cart"></i> Добавить в корзину</a></div>
                        </div>
                    </div>
                    <div class="product-view__harac">
                        <div class="product-view__row">
                            <div class="product-view__col">Авто ::</div>
                            <div class="product-view__col">
                                <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category[0]->id]) ?>"
                                   class="part-model"><i class="fa fa-car"></i> <?= $product->category[0]->name ?></a>
                                /
                                <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category[1]->id]) ?>"
                                   class="part-model"><?= $product->category[1]->name ?></a>
                            </div>
                        </div>
                        <div class="product-view__row">
                            <div class="product-view__col">Аутентичность ::</div>
                            <div class="product-view__col"><?= $product->authenticity ?></div>
                        </div>
                        <div class="product-view__row">
                            <div class="product-view__col">Цвет ::</div>
                            <div class="product-view__col"><?= $product->color ?></div>
                        </div>
                        <div class="product-view__row">
                            <div class="product-view__col">Кузов ::</div>
                            <div class="product-view__col"><?= $product->bodywork ?></div>
                        </div>
                        <div class="product-view__row">
                            <div class="product-view__col">Номер ::</div>
                            <div class="product-view__col"><?= $product->number ?></div>
                        </div>
                        <div class="product-view__row">
                            <div class="product-view__col">Двигатель ::</div>
                            <div class="product-view__col"><?= $product->engine ?></div>
                        </div>
                        <div class="product-view__row">
                            <div class="product-view__col">Год ::</div>
                            <div class="product-view__col"><?= $product->age ?></div>
                        </div>
                        <div class="product-view__row">
                            <div class="product-view__col">L-R ::</div>
                            <div class="product-view__col"><?= $product->l_r ?></div>
                        </div>
                        <div class="product-view__row">
                            <div class="product-view__col">F-R ::</div>
                            <div class="product-view__col"><?= $product->f_r ?></div>
                        </div>
                        <div class="product-view__row">
                            <div class="product-view__col">U-D ::</div>
                            <div class="product-view__col"><?= $product->u_d ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
<?php if (!empty($products)): ?>
    <section class="products padding">
        <div class="container">
            <div class="title">
                <h2 class="title__header">Лучшие запчасти</h2>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <div class="products__flex">
                <?php foreach ($products as $product): ?>
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
            </div>
        </div>
    </section>
<?php endif ?>
