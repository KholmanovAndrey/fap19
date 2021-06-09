<?php

namespace app\controllers;

use app\models\Article;
use yii;
use yii\data\Pagination;

class ArticleController extends AppController {
    private $orderBy = 'id DESC, position';

    public function actionIndex() {
        $query = Article::find()->where(['publication' => 1]);
        $pages = new Pagination(['totalCount' => $query->count(), 'forcePageParam' => false, 'pageSizeParam' => false]);
        $articles = $query->orderBy($this->orderBy)->offset($pages->offset)->limit($pages->limit)->all();

        // устанавлеваем данные мета-тегов
        $this->setMeta('Статьи и советы', 'Все статьи и советы на сайте');
        return $this->render('index', compact('articles', 'pages'));
    }

    public function actionView($id) {
        $article = Article::find()->where(['id' => $id, 'publication' => 1])->one();
        // проверка на существование данных
        if (empty($article)){
            $this->throwError("Категории с идентификатором $id не существует");
        }

        // устанавлеваем данные мета-тегов
        $this->setMeta($article->name, $article->description);
        return $this->render('view', compact('article'));
    }
}
