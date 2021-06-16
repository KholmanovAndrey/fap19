<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="/web/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/web/css/normalize.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="wrapper">
    <div class="wrap">
        <header class="header">
            <div class="header__top">
                <div class="container header__flex1">
                    <div class="header__item">
                        <p>Контактные двигатели, АКПП, <br/>автозапчасти из Японии. <br/><b>Доставка по России и СНГ</b></p>
                    </div>
                    <?= \app\components\ContactWidget::widget() ?>
                    <div class="header__item">
                        <button class="btn btn-warning btn-cart" type="button"><i
                                    class="fas fa-shopping-basket"></i><span class="btn-cart__span"> Корзина</span>
                        </button>
                        <?php if (Yii::$app->request->url !== '/cart' && Yii::$app->request->url !== '/cart/order'): ?>
                            <div class="header__cart cart">
                                <?php
                                $session = Yii::$app->session;
                                $session->open();
                                if (!empty($session['cart'])): ?>
                                    <?php foreach ($session['cart'] as $id => $item): ?>
                                        <div class="cart__item" data-id="1">
                                            <div class="left-block">
                                                <p class="product-title"><?= $item['name'] ?></p>
                                                <div class="product-bio">
                                                    <div class="product-image">
                                                        <img class="cart__img" src="<?php
                                                        $url = explode(',', $item['img']);
                                                        echo $url[0];
                                                        ?>" alt="" class="product-img">
                                                    </div>
                                                    <div class="product-desc">
                                                        <p class="product-quantity">Кол-во: <?= $item['qty'] ?></p>
                                                        <p class="product-single-price"><?= $item['price'] ?> <i
                                                                    class="fas fa-ruble-sign"></i>/шт.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="right-block">
                                                <p class="product-price"><?= $item['qty'] * $item['price'] ?> <i
                                                            class="fas fa-ruble-sign"></i></p>
                                                <button class="btn btn-dark btn-del" data-id="<?= $id ?>">&times;
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                    <a href="<?= \yii\helpers\Url::to(['cart/index']) ?>" class="btn btn-warning">В
                                        корзину</a>
                                    <a href="<?= \yii\helpers\Url::to(['cart/order']) ?>" class="btn btn-warning">Оформить
                                        заказ</a>
                                <?php else: ?>
                                    <h3>Корзина пуста</h3>
                                <?php endif; ?>
                            </div>
                        <?php endif ?>
                        <?php if (Yii::$app->user->isGuest) : ?>
                            <a href="<?= \yii\helpers\Url::to(['site/login']) ?>" class="btn btn-warning btn-log"><i
                                        class="fas fa-sign-in-alt"></i><span class="btn-reg__span"> Вход</span></a>
                            <!--                            <a href="--><? //= \yii\helpers\Url::to(['site/signup1']) ?><!--" class="btn btn-warning btn-reg"><i-->
                            <!--                                        class="fas fa-user-plus"></i><span class="btn-reg__span"> Регистрация</span></a>-->
                        <?php else : ?>
                            <button class="btn btn-warning btn-account" type="button"><i
                                        class="fas fa-user-circle"></i><span
                                        class="btn-account__span"> <?= Yii::$app->user->identity->username ?></span>
                            </button>
                            <div class="header__account">
                                <div class="header__contact header__contact_font">
                                    <span class="btn btn-dark">Данные пользователя</span>
                                    <a href="<?= \yii\helpers\Url::to(['user/profile']) ?>"
                                       class="header__link btn btn-info"><i class="fas fa-atom"></i> Профиль</a>
                                </div>
                                <?php if (Yii::$app->user->can('canAdmin')) : ?>
                                    <div class="header__contact header__contact_font">
                                        <span class="btn btn-dark">Админка</span>
                                        <a href="<?= \yii\helpers\Url::to(['admin/default/index']) ?>"
                                           class="header__link btn btn-info"><i class="fas fa-atom"></i> Админка</a>
                                    </div>
                                <?php endif ?>
                                <?php if (Yii::$app->user->can('seller')) : ?>
                                    <div class="header__contact header__contact_font">
                                        <span class="btn btn-dark">История заказов</span>
                                        <?php if (Yii::$app->user->can('canAcceptOrders')) : ?>
                                            <a href="<?= \yii\helpers\Url::to(['cart/accept']) ?>"
                                               class="header__link btn btn-warning"><i class="fab fa-product-hunt"></i>
                                                Принять заказ</a>
                                        <?php endif ?>
                                        <?php if (Yii::$app->user->can('canHistoryOrders')) : ?>
                                            <a href="<?= \yii\helpers\Url::to(['cart/history']) ?>"
                                               class="header__link btn btn-warning"><i class="fab fa-jedi-order"></i>
                                                Мои заказы</a>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>
                                <?php if (Yii::$app->user->can('shopper')) : ?>
                                    <div class="header__contact header__contact_font">
                                        <span class="btn btn-dark">История заказов</span>
                                        <?php if (Yii::$app->user->can('canHistoryOrders')) : ?>
                                            <a href="<?= \yii\helpers\Url::to(['cart/history']) ?>"
                                               class="header__link btn btn-warning"><i class="fab fa-jedi-order"></i>
                                                Мои заказы</a>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>
                                <div class="header__contact header__contact_font">
                                    <a href="<?= \yii\helpers\Url::to(['site/logout']) ?>"
                                       class="header__link btn btn-danger"><i class="fas fa-user-circle"></i> Выход</a>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="header__bottom">
                <div class="container header__flex2">
                    <a class="logo" href="/"><img class="logo__img" src="/web/img/logo.png" alt="Лого"></a>
                    <nav class="header__nav">
                        <button class="btn btn-dark btn-menu" type="button"><i class="fas fa-bars"></i></i></button>
                        <ul class="menu"><?= \app\components\MenuWidget::widget() ?></ul>
                    </nav>
                </div>
            </div>
        </header>

        <div class="search-wrap">
            <div class="container">
                <form method="get" action="<?= \yii\helpers\Url::to(['category/search']) ?>" id="search" class="search">
                    <select name="manufacturer" id="manufacturer" class="search__select">
                        <option value="0">Выбрать</option>
                        <?= \app\components\CategoryWidget::widget(['tpl' => 'select',
                            'categoryID' => 0,
                            'categoryCurrent' => Yii::$app->request->get('manufacturer'),
                            'cache' => false]) ?>
                    </select>
                    <select name="model" id="model"
                            class="search__select <?= Yii::$app->request->get('manufacturer') ? '' : 'novisible' ?> ">
                        <option value="0">Выбрать</option><?php
                        if (Yii::$app->request->get('manufacturer')):
                            ?><?= \app\components\CategoryWidget::widget(['tpl' => 'select',
                            'categoryID' => Yii::$app->request->get('manufacturer'),
                            'categoryCurrent' => Yii::$app->request->get('model'),
                            'cache' => false]) ?><?php
                        endif; ?>
                    </select>
                    <input type="text" name="name" value="<?= Html::encode(Yii::$app->request->get('name')) ?>"
                           class="search__input" placeholder="Наименование запчасти">
                    <button class="btn btn-warning search__button"><i class="fas fa-search"></i> Поиск</button>
                </form>
            </div>
        </div>

        <?= $content ?>

    </div>
    <footer class="footer">
        <div class="footer__top">
            <div class="container footer__flex">
                <div class="footer__about about">
                    <div class="title">
                        <h3 class="title__header">О компании</h3>
                        <span class="title__line"><i class="fa fa-car"></i></span>
                    </div>
                    <img class="about__img" src="/web/img/logo.png" alt="felix auto parts">
                    <p class="about__text"></p>
                </div>
                <div class="footer__contact contact">
                    <div class="title">
                        <h3 class="title__header">Контакты</h3>
                        <span class="title__line"><i class="fa fa-car"></i></span>
                    </div>
                    <?= \app\components\ContactWidget::widget(['tpl' => 'footer']) ?>
                    <div class="cards mt-5">
                        <?= Html::img('/web/img/cards.png', ['alt' => 'Способы оплаты безналичного расчета']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                    Все права защищены | Сайт создан <a href="http://vebos.ru" target="_blank">веб-студией "VEBOS
                        GROUP"</a></p>
            </div>
        </div>
    </footer>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
