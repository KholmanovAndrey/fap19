<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact padding">
    <div class="container">
        <div class="title">
            <h1><?= Html::encode($this->title) ?></h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>
        <div class="contact__flex">
            <div class="contact__inform">
                <h5>Связаться с нами можно по:</h5>
                <p class="c"><i class="fas fa-map-marker-alt"></i> <?= $contact->adress ?></p>
                <p class="c">
                    <?php
                    foreach ($phones as $phone) :?>
                        <a href="tel:<?= $phone->tel ?>" class="header__item mr-2">
                            <i class="fas fa-mobile-alt"></i>
                            <?php if ($phone->socials) : $socials = explode(',', $phone->socials)?>
                                <?php foreach ($socials as $social) :?>
                                    <i class="<?= $social ?>"></i>
                                <?php endforeach ?>
                            <?php endif ?>
                            <?= $phone->tel ?><?= ($phone->contact) ? ' - ' . $phone->contact : '' ?>
                        </a>
                    <?php endforeach ?>
                </p>
                <p class="c">
                    <?php
                    foreach ($emails as $item) :?>
                        <a href="mailto:<?= $item->email ?>" class="mr-2">
                            <i class="fas fa-envelope-open"></i>
                            <?= $item->email ?><?= ($item->contact) ? ' - ' . $item->contact : '' ?>
                        </a>
                    <?php endforeach ?>
                </p>
                <h5 class="mt-5">Реквизиты организации</h5>
                <table class="text-left">
                    <tr>
                        <td class="pr-2">Наименование:</td>
                        <td>ИП Филисова Наталья Владимировна</td>
                    </tr>
                    <tr>
                        <td class="pr-2">ОГРН/ИНН:</td>
                        <td>304190104300096/19010043914</td>
                    </tr>
                    <tr>
                        <td class="pr-2">Почтовый адрес:</td>
                        <td>655011, Республика Хакасия, г. Абакан, ул. Восточная 18-1</td>
                    </tr>
                    <tr>
                        <td class="pr-2">Физический адрес:</td>
                        <td>655011, Республика Хакасия, г. Абакан, ул. Восточная 18-1</td>
                    </tr>
                    <tr>
                        <td class="pr-2">Юридический адрес:</td>
                        <td>655011, Республика Хакасия, г. Абакан, ул. Восточная 18-1</td>
                    </tr>
                </table>
            </div>
            <div class="contact__form">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A0cdd4e0b83873b9f71f7cc281455c86adc2829cb53aa143e085a01143a023c3c&amp;width=100%25&amp;height=500&amp;lang=ru_RU&amp;scroll=true"></script>
            </div>
        </div>
    </div>
</div>