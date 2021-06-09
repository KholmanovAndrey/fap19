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
        <link rel="stylesheet" href="/web/css/normalize.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
              integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
              crossorigin="anonymous">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <div class="wrap">
            <header class="header">
                <div class="header__top">
                    <div class="container header__flex1">
                        <a href="/" target="_blank"><i class="fas fa-door-open"></i> Перейти на сайт</a>
                        <a href="<?= \yii\helpers\Url::to(['/site/logout']) ?>"><i class="fas fa-door-closed"></i> Выход
                            из админки</a>
                    </div>
                </div>
                <div class="header__bottom">
                    <div class="container header__flex2">
                        <a class="logo" href="/"><img class="logo__img" src="/web/img/logo.png" alt="Лого"></a>
                        <nav class="header__nav">
                            <button class="btn btn-dark btn-menu" type="button"><i class="fas fa-bars"></i></i></button>
                            <ul class="menu">
                                <li class="menu__list"><a class="menu__link"
                                                          href="<?= \yii\helpers\Url::to(['order/index']) ?>">Заказы</a>
                                </li>
                                <li class="menu__list"><a class="menu__link"
                                                          href="<?= \yii\helpers\Url::to(['category/index']) ?>">Категории</a>
                                </li>
                                <li class="menu__list"><a class="menu__link"
                                                          href="<?= \yii\helpers\Url::to(['product/index']) ?>">Запчасти</a>
                                </li>
                                <li class="menu__list"><a class="menu__link"
                                                          href="<?= \yii\helpers\Url::to(['article/index']) ?>">Статьи</a>
                                </li>
                                <?php if (Yii::$app->user->can('admin')) : ?>
                                    <li class="menu__list"><a class="menu__link"
                                                              href="<?= \yii\helpers\Url::to(['user/index']) ?>">Пользователи</a>
                                    </li>
                                <?php endif ?>
                                <?php if (Yii::$app->user->can('admin')) : ?>
                                    <li class="menu__list"><a class="menu__link"
                                                              href="<?= \yii\helpers\Url::to(['import/index']) ?>">Импорт</a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>

            <?php if (Yii::$app->session->getFlash('success')) : ?>
                <div class="alert alert-success alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif ?>

            <?php if (Yii::$app->session->getFlash('error')) : ?>
                <div class="alert alert-danger alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif ?>

            <?= $content ?>
        </div>
        <footer class="footer">
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