<?php if (!empty($orders)) : ?>
    <section class="orders padding">
        <div class="container">
            <div class="title">
                <h1 class="title__header">Заказы</h1>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <div class="order order_header">
                <div class="order__col order__col_header order__col_1">ID</div>
                <div class="order__col order__col_header order__col_2">Дата создания</div>
                <div class="order__col order__col_header order__col_2">Дата изменения</div>
                <div class="order__col order__col_header order__col_3">Статус</div>
                <div class="order__col order__col_header order__col_4"></div>
            </div>
            <?php foreach ($orders as $order) : ?>
                <div class="order">
                    <div class="order__col order__col_1"><?= $order->id ?></div>
                    <div class="order__col order__col_2"><?
                        $created_at = explode(' ', $order->created_at);
                        $updated_at = explode(' ', $order->created_at);
                        ?><?= $created_at[0] ?><span class="order__span"> <?= $created_at[1] ?></span></div>
                    <div class="order__col order__col_2"><?= $updated_at[0] ?><span
                                class="order__span"> <?= $updated_at[1] ?></span></div>
                    <div class="order__col order__col_3"><?php
                        if ((int)$order->status === 0) {
                            echo '<span class="btn btn-primary">Новый</span>';
                        } elseif ((int)$order->status === 1) {
                            echo '<span class="btn btn-warning">Принят</span>';
                        } elseif ((int)$order->status === 2) {
                            echo '<span class="btn btn-success">Выполнен</span>';
                        } elseif ((int)$order->status === 3) {
                            echo '<span class="btn btn-danger">Отменен</span>';
                        }
                        ?></div>
                    <div class="order__col order__col_4 order__flex">
                        <button class="order__link btn btn-warning details-button"
                                data-id="<?= $order->id ?>"><i data-id="<?= $order->id ?>"
                                                               class="fas fa-info-circle"></i><span class="order__span"
                                                                                                    data-id="<?= $order->id ?>"> Детали</span>
                        </button>
                        <a href="<?= \yii\helpers\Url::to(['cart/accept', 'id' => $order->id, 'accept' => 1]) ?>" class="order__link btn btn-warning" id="accept" data-id="<?= $order->id ?>"><i
                                    class="fas fa-check"></i><span
                                    class="order__span"> Принять</span></a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
<?php else : ?>
    <div class="orders padding">
        <div class="container">
            <div class="title">
                <h2 class="title__header">Заказы</h2>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <h3>Заказов нет</h3>
        </div>
    </div>
<?php endif ?>