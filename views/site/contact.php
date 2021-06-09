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
<!--                <a href="https://goo.gl/maps/b5mt45MCaPB2" class="btn btn-warning" target="_blank">Показать-->
<!--                    расположение на карте</a>-->
            </div>
            <div class="contact__form">
<!--                --><?php //if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
<!--                    <div class="alert alert-success">Благодарим Вас за обращение к нам. Мы ответим вам как можно-->
<!--                        скорее.-->
<!--                    </div>-->
<!--                --><?php //else: ?>
<!--                    <h5>Если у вас есть деловые вопросы или другие вопросы, пожалуйста, заполните следующую форму, чтобы-->
<!--                        связаться с нами.</h5>-->
<!--                    --><?php //$form = ActiveForm::begin(['id' => 'contact-form']); ?>
<!---->
<!--                    --><?//= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
<!---->
<!--                    --><?//= $form->field($model, 'email') ?>
<!---->
<!--                    --><?//= $form->field($model, 'subject') ?>
<!---->
<!--                    --><?//= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
<!---->
<!--                    --><?//= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
//                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
//                ]) ?>
<!---->
<!--                    <div class="form-group">-->
<!--                        --><?//= Html::submitButton('Отправить', ['class' => 'btn btn-warning', 'name' => 'contact-button']) ?>
<!--                    </div>-->
<!---->
<!--                    --><?php //ActiveForm::end(); ?>
<!--                --><?php //endif; ?>

                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A0cdd4e0b83873b9f71f7cc281455c86adc2829cb53aa143e085a01143a023c3c&amp;width=100%25&amp;height=500&amp;lang=ru_RU&amp;scroll=true"></script>
            </div>
        </div>
    </div>
</div>