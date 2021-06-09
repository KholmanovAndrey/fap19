<?php

namespace app\controllers;
use yii\web\Controller;
use yii;

class AppController extends Controller{
    /**
     * Установка значений Мета-тегов
     * @param {string} $title - значение для тега <title>
     * @param {string} $description - значение для тега <meta name="description">
     * @param {string} $keywords - значение для тега <meta name="keywords">
     */
    protected function setMeta($title, $description = null, $keywords = null) {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
    }

    /**
     * Вывод страницы ошибки 404
     * @param $message - сообщение
     * @throws yii\web\HttpException
     */
    protected function throwError($message) {
        throw new yii\web\HttpException(404, $message);
    }
}