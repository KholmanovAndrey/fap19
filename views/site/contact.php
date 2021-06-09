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
                    $phones = explode('||', $contact->phone);
                    foreach ($phones as $phone) :
                        if ($phone !== '') : $phone = explode(':', $phone); ?>
                            <a href="tel:<?= $phone[0] ?>" class="header__item"><i
                                        class="fas fa-mobile-alt"></i> <?= $phone[0] ?><?= ($phone[1]) ? ' - ' . $phone[1] : '' ?>
                            </a>
                        <?php endif ?>
                    <?php endforeach ?>
                </p>
                <p class="c">
                    <?php
                    $emails = explode('||', $contact->email);
                    foreach ($emails as $email) :
                        if ($email !== '') : $email = explode(':', $email); ?>
                            <a href="mailto:<?= $email[0] ?>"><i
                                        class="fas fa-envelope-open"></i> <?= $email[0] ?><?= ($email[1]) ? ' - ' . $email[1] : '' ?>
                            </a>
                        <?php endif ?>
                    <?php endforeach ?>
                </p>
            </div>
            <div class="contact__form">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A0cdd4e0b83873b9f71f7cc281455c86adc2829cb53aa143e085a01143a023c3c&amp;width=100%25&amp;height=500&amp;lang=ru_RU&amp;scroll=true"></script>
            </div>
        </div>
    </div>
</div>