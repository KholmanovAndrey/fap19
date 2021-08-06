<?php

use yii\helpers\Html;

?>
<?php if (!empty($articles)): ?>
    <section class="articles padding">
        <div class="container">
            <div class="title">
                <h1 class="title__header">Советы и статьи</h1>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <div class="articles__content">
                <?php foreach ($articles as $article): ?>
                    <article class="article">
                        <div class="article__thumb">
                            <?php if ($article->image != Null):
                                $image = explode(',', $article->image) ?>
                                <?= Html::img('/web/img/article/' . $article->image, ['alt' => $article->alias]); ?>
                            <?php else: ?>
                                <?= Html::img('/web/img/product/no-image.png', ['alt' => $article->alias]); ?>
                            <?php endif ?>
                        </div>
                        <div class="article__body">
                            <h3>
                                <a href="<?= \yii\helpers\Url::to(['article/view', 'id' => $article->id]) ?>"><?= $article->
                                    name ?></a></h3>
<!--                            <div class="article__date">25 <span class="month">янв</span></div>-->
                            <p><?= $article->description ?></p>
                            <a class="btn btn-warning"
                               href="<?= \yii\helpers\Url::to(['article/view', 'id' => $article->id]) ?>" class="btn2">Читать
                                далее <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </article>
                <?php endforeach ?>
            </div>
            <?php echo \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
        </div>
    </section>
<?php else: ?>
    <h3>Здесь статей нет</h3>
<?php endif ?>