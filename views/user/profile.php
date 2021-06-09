<?php
/**
 * @var \App\models\User $user
 */
?>
<div class="container">
    <div class="user-single padding">
        <div class="title">
            <h1 class="title__header"><?= $user->fio ?: 'ФИО не задано' ?></h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>
        <p class="user-single__p">Логин: <?= $user->username ?></p>
        <p class="user-single__p">E-mail: <?= $user->email ?: 'не задан' ?></p>
        <p class="user-single__p">Телефон: <?= $user->phone ?: 'не задан' ?></p>
        <p class="user-single__p">Адрес: <?= $user->adress ?: 'не задан' ?></p>
        <div class="user-single__action">
            <a href="<?= \yii\helpers\Url::to(['user/update', 'id' => $user->id]) ?>" class="user-single__link btn btn-dark">Редактировать данные</a>
            <a href="<?= \yii\helpers\Url::to(['user/change-password', 'id' => $user->id]) ?>" class="user-single__link btn btn-dark">Сменить пароль</a>
        </div>
    </div>
</div>