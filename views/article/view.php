<?php

use yii\helpers\Html;

?>
<?php if (!empty($article)): ?>
    <section class="articles padding">
        <div class="container">
            <div class="title">
                <h1 class="title__header"><?= $article->name ?></h1>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <div class="article-view">
                <div class="article-view__body">
                    <?php if ($article->image != Null):
                        $image = explode(',', $article->image) ?>
                        <?= Html::img('/web/img/article/' . $article->image,
                        ['alt' => $article->alias, 'class' => 'article-view__img']); ?>
                    <?php endif ?>
                    <div class="article-view__date">Дата создания статьи :: 25 <span class="month">января</span> 2018
                    </div>
                    <?= $article->text ?>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <h3>Здесь товаров нет</h3>
<?php endif ?>