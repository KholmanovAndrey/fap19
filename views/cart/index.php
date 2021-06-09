<?php if (!empty($session['cart'])): ?>
    <section class="cart-ones padding">
        <div class="container">
            <div class="title">
                <h1 class="title__header">Корзина заказов</h1>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <div class="cart-one">
                <div class="cart-one__col cart-one__col_header cart-one__col_1">Картинка</div>
                <div class="cart-one__col cart-one__col_header cart-one__col_2">Наименование</div>
                <div class="cart-one__col cart-one__col_header cart-one__col_3">Кол-во</div>
                <div class="cart-one__col cart-one__col_header cart-one__col_3">Цена, рублей</div>
                <div class="cart-one__col cart-one__col_header cart-one__col_4"></div>
            </div>
            <?php foreach ($session['cart'] as $id => $item): ?>
                <div class="cart-one">
                    <div class="cart-one__col cart-one__col_1"><img class="cart-one__img" src="<?php
                        $url = explode(',', $item['img']);
                        echo $url[0];
                        ?>" alt=""></div>
                    <div class="cart-one__col cart-one__col_2"><?= $item['name'] ?></div>
                    <div class="cart-one__col cart-one__col_3"><?= $item['qty'] ?></div>
                    <div class="cart-one__col cart-one__col_3"><?= $item['price'] ?></div>
                    <div class="cart-one__col cart-one__col_4 cart-one__col_del btn-del">
                        <button class="btn btn-dark btn-del" data-id="<?= $id ?>">&times;</button>
                    </div>
                </div>
            <?php endforeach ?>
            <div class="cart-one">
                <div class="cart-one__col cart-one__col_1"></div>
                <div class="cart-one__col cart-one__col_2 cart-one__col_right">Итого:</div>
                <div class="cart-one__col cart-one__col_3"><?= $session['cart.qty'] ?></div>
                <div class="cart-one__col cart-one__col_3"><?= $session['cart.sum'] ?></div>
                <div class="cart-one__col cart-one__col_4"></div>
            </div>
            <div class="cart-one">
                <a href="<?= \yii\helpers\Url::to(['cart/order']) ?>" class="btn btn-warning">Оформить заказ</a>
                <a href="<?= \yii\helpers\Url::to(['cart/clear']) ?>" class="btn btn-warning cart-one-clear">Очистить корзину</a>
            </div>
        </div>
    </section>
<?php else : ?>
    <div class="orders padding">
        <div class="container">
            <div class="title">
                <h2 class="title__header">Корзина заказов</h2>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <h3>Корзина заказов пуста</h3>
        </div>
    </div>
<?php endif ?>
