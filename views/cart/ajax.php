<?php if (!empty($session['cart'])): ?>
    <?php foreach ($session['cart'] as $id => $item): ?>
        <div class="cart__item" data-id="1">
            <div class="left-block">
                <p class="product-title"><?= $item['name'] ?></p>
                <div class="product-bio">
                    <div class="product-image">
                        <img class="cart__img" src="<?php
                        $url = explode(',', $item['img']);
                        echo $url[0];
                        ?>" alt="" class="product-img">
                    </div>
                    <div class="product-desc">
                        <p class="product-quantity">Кол-во: <?= $item['qty'] ?></p>
                        <p class="product-single-price"><?= $item['price'] ?> <i
                                    class="fas fa-ruble-sign"></i>/шт.
                        </p>
                    </div>
                </div>
            </div>
            <div class="right-block">
                <p class="product-price"><?= $item['qty'] * $item['price'] ?> <i
                            class="fas fa-ruble-sign"></i></p>
                <button class="btn btn-dark btn-del" data-id="<?= $id ?>">&times;
                </button>
            </div>
        </div>
    <?php endforeach ?>
    <a href="<?= \yii\helpers\Url::to(['cart/index']) ?>" class="btn btn-warning">В
        корзину</a>
    <a href="<?= \yii\helpers\Url::to(['cart/order']) ?>" class="btn btn-warning">Оформить
        заказ</a>
<?php else: ?>
    <h3>Корзина пуста</h3>
<?php endif; ?>
