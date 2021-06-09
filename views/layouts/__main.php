<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header class="header">
    <div class="header__top">
        <div class="container header__flex">
            <div class="header__contact header__contact_none"><i class="header__fa fas fa-map-marker-alt"></i> 655017, Абакан, ул. Л. Комсомола 102</div>
            <div class="header__contact header__contact_grow"><a href="tel:+79135443155" class="header__link"><i class="header__fa fas fa-mobile-alt"></i> +7 (913) 544-31-55</a></div>
            <div class="header__contact header__contact_none"><i class="header__fa far fa-clock"></i> Пн-Пт 09.00 - 17.00</div>
            <?php if (Yii::$app->user->isGuest) : ?>
            <div class="header__contact header__contact_font"><a href="<?= \yii\helpers\Url::to(['site/login']) ?>" class="header__link"><i class="header__fa fas fa-user-circle"></i> Войти</a></div>
            <?php else : ?>
            <div class="header__contact header__contact_font"><a href="<?= \yii\helpers\Url::to(['site/logout']) ?>" class="header__link"><i class="header__fa fas fa-user-circle"></i> <?= Yii::$app->user->identity->username ?> (Выход)</a></div>
            <?php  endif?>
            <div class="header__contact header__contact_font header__cart-open">
                <a class="header__link"><i class="header__fa fas fa-shopping-basket"></i> Корзина</a>
                <?php if(Yii::$app->request->url !== '/cart' && Yii::$app->request->url !== '/cart/order' ):?>
                <div class="header__cart">
                    <div class="cart">
                        <div class="cart__flex">
                            <div class="cart__elem cart__elem_image">Картинка</div>
                            <div class="cart__elem cart__elem_name">Наименование</div>
                            <div class="cart__elem cart__elem_qty">Кол-во</div>
                            <div class="cart__elem cart__elem_price">Цена, рублей</div>
                            <div class="cart__elem cart__elem_del"><i class="fas fa-backspace"></i></div>
                        </div>
                        <div class="cartBox">
                            <div class="cartItems">
                                <?php
                                $session = Yii::$app->session;
                                $session->open();
                                if (!empty($session['cart'])): ?>
                                    <?php foreach($session['cart'] as $id => $item): ?>
                                        <div class="cart__flex">
                                            <div class="cart__elem cart__elem_image"><img class="cart__img" src="<?php
                                                $url = explode(',', $item['img']);
                                                echo $url[0];
                                                ?>" alt=""></div>
                                            <div class="cart__elem cart__elem_name"><?= $item['name'] ?></div>
                                            <div class="cart__elem cart__elem_qty"><?= $item['qty'] ?></div>
                                            <div class="cart__elem cart__elem_price"><?= $item['price'] ?></div>
                                            <div class="cart__elem cart__elem_del" data-id="<?= $id ?>"><i class="fas fa-backspace"></i></div>
                                        </div>
                                    <?php endforeach; ?>
                                    <div class="cart__flex">
                                        <div class="cart__elem cart__elem_image"></div>
                                        <div class="cart__elem cart__elem_name">Итого:</div>
                                        <div class="cart__elem cart__elem_qty cartQty"><?= $session['cart.qty'] ?></div>
                                        <div class="cart__elem cart__elem_price cartPrice"><?= $session['cart.sum'] ?></div>
                                        <div class="cart__elem cart__elem_del"></div>
                                    </div>
                                <?php else: ?>
                                    <h3>Корзина пуста</h3>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="cart__flex">
                            <a href="<?= \yii\helpers\Url::to(['cart/order']) ?>" class="button">Оформить заказ</a>
                            <a href="<?= \yii\helpers\Url::to(['cart/index']) ?>" class="button">Перейти в корзину</a>
                        </div>
                    </div>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div id="header-bottom">
        <div class="container">
            <a href="/" class="logo">
                <img src="/web/img/logo.png" alt="felix auto parts">
            </a>

            <nav class="mainmenu"><ul><li class="mobile"><a><i class="fa fa-bars"></i></a></li><?= \app\components\MenuWidget::widget() ?></ul></nav>
        </div>
    </div>
</header>

<div id="search-part">
    <div class="container">
        <form method="get" action="<?= \yii\helpers\Url::to(['category/search']) ?>" class="search-part-form">
            <div class="item">
                <label><h4>Марка авто:</h4>
                <select name="marka" class="custom-select">
                    <option value="0" selected>Выберите</option>
                    <?= \app\components\CategoryWidget::widget(['tpl' => 'select',
                        'categoryID' => 0,
                        'categoryCurrent' => Yii::$app->request->get('marka'),
                        'cache' => false]) ?>
                </select></label>
            </div>
            <div class="item">
                <label><h4>Модель авто:</h4>
                <select name="model" class="custom-select">
                    <option value="0" selected>Выберите</option><?php
                    if (Yii::$app->request->get('marka')):
                    ?><?= \app\components\CategoryWidget::widget(['tpl' => 'select',
                        'categoryID' => Yii::$app->request->get('marka'),
                        'categoryCurrent' => Yii::$app->request->get('model'),
                        'cache' => false]) ?><?php
                    endif;
                    ?>
                </select></label>
            </div>
            <div class="item">
                <label><h4>Запчасть:</h4>
                <input type="text" name="part" value="<?= Html::encode(Yii::$app->request->get('part')) ?>" placeholder="Наименование запчасти"></label>
            </div>
            <div class="item">
                <button type="submit" class="btn"><i class="fa fa-search"></i> Поиск запчасти</button>
            </div>
        </form>
    </div>
</div>

<?= $content ?>

<footer>
    <div id="footer-top">
        <div class="container">
            <div class="about">
                <h3>О компании</h3>
                <a href="index.html">
                    <img src="/web/img/logo.png" alt="felix auto parts">
                </a>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis, sint.</p>
            </div>
            <div class="recent-post">
                <h3>Последние статьи</h3>
                <ul>
                    <li>
                        <a href="article.html">
                           Привет Абакан!
                           <i class="fa fa-long-arrow-right"></i>
                       </a>
                    </li>
                    <li>
                        <a href="article.html">
                            Новое поступление товара!
                            <i class="fa fa-long-arrow-right"></i>
                       </a>
                    </li>
                    <li>
                        <a href="article.html">
                           Заказ возможен через сайт
                           <i class="fa fa-long-arrow-right"></i>
                       </a>
                    </li>
                    <li>
                        <a href="article.html">
                            Лучшее авто месяца
                           <i class="fa fa-long-arrow-right"></i>
                       </a>
                    </li>
                </ul>
            </div>
            <div class="contact">
                <h3>Контакты</h3>
                <p>Связаться с нами можно по:</p>
                <p class="c"><i class="fa fa-map-marker"></i> 655017, Абакан, ул. Л. Комсомола 102</p>
                <p class="c"><i class="fa fa-mobile"></i> <a href="tel:+79135443155">+7 (913) 544-31-55</a></p>
                <p class="c"><i class="fa fa-envelope"></i> <a href="mailto:consultant@fap.ru">consultant@fap.ru</a></p>
                <a href="https://goo.gl/maps/b5mt45MCaPB2" class="btn" target="_blank">Показать расположение на карте</a>
            </div>
        </div>
    </div>
    <div id="footer-bottom">
        <div class="container">
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Все права защищены | Сайт создан <a href="http://vebos.ru" target="_blank">веб-студией "VEBOS GROUP"</a></p>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
