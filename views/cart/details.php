<div class="details" id="details-form">
    <div class="container">
        <div class="details__box">
            <div class="title">
                <h2 class="title__header">Детали заказа</h2>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <div class="details__close btn btn-dark" id="details-close">x</div>
            <div class="details__overflow">
                <div class="details__contacts">
                    <div class="details__contact">ФИО</div>
                    <div class="details__contact"><?= $order->name ?></div>
                    <div class="details__contact">E-mail:</div>
                    <div class="details__contact"><?= $order->email ?></div>
                    <div class="details__contact">Телефон:</div>
                    <div class="details__contact"><?= $order->phone ?></div>
                    <div class="details__contact">Адрес:</div>
                    <div class="details__contact"><?= $order->address ?></div>
                    <div class="details__contact">Доставка:</div>
                    <div class="details__contact"><?= $order->delivery->name ?>
                        <?php if ($order->transportCompany) :?>
                        "<?= $order->transportCompany->title ?>"
                        <?php endif?>
                    </div>
                    <div class="details__contact">Оплата:</div>
                    <div class="details__contact"><?= $order->payment->name ?></div>
                </div>
                <div class="cart-one">
                    <div class="cart-one__col cart-one__col_header cart-one__col_2">Наименование</div>
                    <div class="cart-one__col cart-one__col_header cart-one__col_3">Цена, рублей</div>
                    <div class="cart-one__col cart-one__col_header cart-one__col_3">Кол-во</div>
                    <div class="cart-one__col cart-one__col_header cart-one__col_3">Сумма, рублей</div>
                </div>
                <?php foreach ($details as $id => $item): ?>
                    <div class="cart-one">
                        <div class="cart-one__col cart-one__col_2"><?= $item['name'] ?></div>
                        <div class="cart-one__col cart-one__col_3"><?= $item['price'] ?></div>
                        <div class="cart-one__col cart-one__col_3"><?= $item['qty_item'] ?></div>
                        <div class="cart-one__col cart-one__col_3"><?= $item['sum_item'] ?></div>
                    </div>
                <?php endforeach ?>
                <div class="cart-one">
                    <div class="cart-one__col cart-one__col_2"></div>
                    <div class="cart-one__col cart-one__col_3">Итого:</div>
                    <div class="cart-one__col cart-one__col_3"><?= $order['qty'] ?></div>
                    <div class="cart-one__col cart-one__col_3"><?= $order['sum'] ?></div>
                </div>
            </div>
        </div>
    </div>
</div>