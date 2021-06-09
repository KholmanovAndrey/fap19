<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Product;
use yii\data\Pagination;

class CategoryController extends AppController {
    private $orderBy = 'id DESC, position';

    public function actionIndex() {
        $query = Product::find()->where(['publication' => 1]);
        $pages = new Pagination(['totalCount' => $query->count(), 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->orderBy($this->orderBy)->offset($pages->offset)->limit($pages->limit)
            ->with('category')->all();

        // устанавлеваем данные мета-тегов
        $this->setMeta('Все запчасти', 'Полный список запчастей на автомобили');

        return $this->render('index', compact('products', 'pages'));
    }

    public function actionView($id) {
        $category = Category::find()->where(['publication' => 1, 'id' => $id])->one();
        // проверка на существование данных
        if (empty($category)){
            $this->throwError("Категории с идентификатором $id не существует");
        }

        $query = Product::find()->innerJoin('product_category','product.id = product_category.product_id')
            ->where(['publication' => 1, 'product_category.category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->orderBy($this->orderBy)->offset($pages->offset)->limit($pages->limit)->all();

        $parent_id = $category->parent_id;
        $parent_category = Category::find()->where(['publication' => 1, 'id' => $parent_id])->one();
        $parent = (!empty($parent_category))?$parent_category->name . ' ':'';

        // устанавлеваем данные мета-тегов
        $this->setMeta('Запчасти на автомобиль ' . $parent . $category->name,
            'Запчасти на автомобиль ' . $parent . $category->name);

        return $this->render('view', compact('category', 'parent_category', 'products', 'pages'));

    }

    public function actionSearch($manufacturer, $model, $name) {
        $manufacturer = (int)$manufacturer;
        $model = (int)$model;
        $name = trim($name);

        if ($model === 0 && $manufacturer === 0 && $name === '') {
            return $this->render('search');
        }

        if ($model !== 0) {
            $manufacturerCategory = Category::findOne($manufacturer);
            $modelCategory = Category::findOne($model);
            $query = Product::find()->innerJoin('product_category','product.id = product_category.product_id')
                ->where(['publication' => 1,
                    'product_category.category_id' => $model])
                ->andWhere(['like', 'name', $name]);
        } else if ($model === 0 && $manufacturer !== 0) {
            $manufacturerCategory = Category::findOne($manufacturer);
            $modelCategory = Category::findOne($model);
            $query = Product::find()->innerJoin('product_category','product.id = product_category.product_id')
                ->where(['publication' => 1,
                    'product_category.category_id' => $manufacturer])
                ->andWhere(['like', 'name', $name]);
        } else {
            $query = Product::find()->where(['publication' => 1])->andWhere(['like', 'name', $name]);
        }
        $pages = new Pagination(['totalCount' => $query->count(), 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->orderBy($this->orderBy)->offset($pages->offset)->limit($pages->limit)->all();

        // устанавлеваем данные мета-тегов
        $this->setMeta(trim("Поиск: $manufacturerCategory->name $modelCategory->name $name"));

        return $this->render('search', compact('products', 'pages',
            'marka', 'markaCategory', 'model', 'modelCategory', 'part'));
    }

    public function actionSelect($id) {
        // проверка на работу ajax
        if (!Yii::$app->request->isAjax){
            return $this->redirect(Yii::$app->request->referrer);
        }

        // убираем шаблон
        $this->layout = false;

        return $this->render('select', compact('id'));
    }
}