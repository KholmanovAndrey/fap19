<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'О компании';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (!empty($about)): ?>
    <div class="about-index padding">
        <article class="container">
            <div class="title">
                <h1 class="title__header"><?= Html::encode($about->name) ?></h1>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <div class="about-index__flex">
                <div class="about-index__text"><?= $about->text ?></div>
                <div class="about-index__image"><?= Html::img('/web/img/article/' . $about->image, ['alt' =>
                        $about->alias]); ?>
                </div>
            </div>
        </article>
    </div>
<?php endif ?>