<?php

namespace app\controllers;

use app\models\Product;
use yii\data\Pagination;
use Yii;

class ProductController extends AppController {
    private $orderBy = 'id DESC, position';
    /**
     * Загрузка страницы View
     * @return string {string} string - возвращает html код
     */
    public function actionView($id) {
        $product = Product::find()->where(['id' => $id, 'publication' => 1])->one();
        // проверка на существование данных
        if (empty($product)){
            $this->throwError("Запчасти с идентификатором $id не существует");
        }

        // Получаем другие товары для вывода
        $products = Product::find()->where(['publication' => 1])->orderBy($this->orderBy)
            ->limit(6)->with('category')->all();

        // устанавлеваем данные мета-тегов
        $this->setMeta($product->name, $product->noticy);
        return $this->render('view', compact('product', 'products'));
    }
}
