<?php

use yii\helpers\Url;

?>
<div class="cartOne">
    <div class="cart__flex">
        <div class="cart__elem cart__elem_image">Картинка</div>
        <div class="cart__elem cart__elem_name">Наименование</div>
        <div class="cart__elem cart__elem_qty">Кол-во</div>
        <div class="cart__elem cart__elem_price">Цена, рублей</div>
        <div class="cart__elem cart__elem_price">Сумма, рублей</div>
    </div>
    <div class="cartBox">
        <div class="cartItems">
            <?php foreach($session['cart'] as $id => $item): ?>
                <div class="cart__flex">
                    <div class="cart__elem cart__elem_name"><a href="<?= Url::to(['product/view', 'id' => $id]) ?>"><?= $item['name'] ?></a></div>
                    <div class="cart__elem cart__elem_qty"><?= $item['qty'] ?></div>
                    <div class="cart__elem cart__elem_price"><?= $item['price'] ?></div>
                    <div class="cart__elem cart__elem_price"><?= $item['qty'] * $item['price'] ?></div>
                </div>
            <?php endforeach; ?>
            <div class="cart__flex">
                <div class="cart__elem cart__elem_name">Итого:</div>
                <div class="cart__elem cart__elem_qty cartQty"><?= $session['cart.qty'] ?></div>
                <div class="cart__elem cart__elem_price cartPrice"><?= $session['cart.sum'] ?></div>
            </div>
        </div>
    </div>
</div>