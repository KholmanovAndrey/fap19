<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<?php if (!empty($session['cart'])): ?>
    <section class="cart-ones padding">
        <div class="container">
            <div class="title">
                <h1 class="title__header">Оформление заказов</h1>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <?php if (Yii::$app->session->getFlash('error')) : ?>
                <div class="alert alert-danger alert-dismissable" role="alert">
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif ?>

            <?php $form = ActiveForm::begin(); ?>
            <h2 class="cart-ones__h2">Контактрая информация</h2>
            <?= $form->field($order, 'shopper_id')->hiddenInput(['value' => $user->id])->label(false); ?>
            <?= $form->field($order, 'name')->input('text', ['value' => $user->fio, 'required'=>true]); ?>
            <?= $form->field($order, 'email')->input('email', ['value' => $user->email, 'required'=>true]); ?>
            <?= $form->field($order, 'phone')->input('phone', ['value' => $user->phone, 'required'=>true]); ?>
            <?= $form->field($order, 'address')->input('address', ['value' => $user->adress, 'required'=>true]); ?>

            <div id="delivery">
                <h2 class="cart-ones__h2">Доставка</h2>
                <?
                foreach ($delivery as $deli) {
                    $delivery_arr[$deli->id] = [0 => $deli->name, 1 => $deli->description];
                }
                ?>
                <?=
                $form->field($order, 'delivery_id')
                    ->radioList(
                        $delivery_arr,
                        [
                            'item' => function($index, $label, $name, $checked, $value) {

                                $return = '<label class="modal-radio">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                                $return .= '<i></i>';
                                $return .= ' <b>' . ucwords($label[0]) . '</b><br/>';
                                $return .= ' <span>' . ucwords($label[1]) . '</span>';
                                $return .= '</label><br/>';

                                return $return;
                            }
                        ]
                    )
                    ->label(false);
                ?>
            </div>

            <div id="transport">
                <h2 class="cart-ones__h2">Транспортные компании</h2>
                <?
                foreach ($transportCompanies as $company) {
                    $company_arr[$company->id] = [0 => $company->name, 1 => $company->title];
                }
                ?>
                <?=
                $form->field($order, 'transport_id')
                    ->radioList(
                        $company_arr,
                        [
                            'item' => function($index, $label, $name, $checked, $value) {

                                $return = '<label class="modal-radio mr-5">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3">';
                                $return .= '<i></i>';
                                $return .= ' <b>' . ucwords($label[1]) . '</b>';
                                $return .= '</label>';

                                return $return;
                            }
                        ]
                    )
                    ->label(false);
                ?>
            </div>
<!---->
<!--            <div id="transport">-->
<!--                <h2 class="cart-ones__h2">Транспортная компания "СДЕК"</h2>-->
<!--                <script id="ISDEKscript" type="text/javascript" src="https://widget.cdek.ru/widget/widjet.js" charset="utf-8"></script>-->
<!--                <script type="text/javascript">-->
<!--                    var orderWidjet = new ISDEKWidjet({-->
<!--                        popup: true,-->
<!--                        defaultCity: 'Абакан',-->
<!--                        cityFrom: 'Абакан',-->
<!--                        goods: [ // установим данные о товарах из корзины-->
<!--                            { length : 10, width : 20, height : 20, weight : 5 }-->
<!--                        ],-->
<!--                        onReady : function(){ // на загрузку виджета отобразим информацию о доставке до ПВЗ-->
<!--                            ipjq('#linkForWidjet').css('display','inline');-->
<!--                        },-->
<!--                        onChoose : function(info){ // при выборе ПВЗ: запишем номер ПВЗ в текстовое поле и доп. информацию-->
<!--                            ipjq('[name="chosenPost"]').val(info.id);-->
<!--                            ipjq('[name="addresPost"]').val(info.PVZ.Address);-->
<!--                            // расчет стоимости доставки-->
<!--                            var price = (info.price < 500) ? 500 : Math.ceil( info.price/100 ) * 100;-->
<!--                            ipjq('[name="pricePost"]').val(price);-->
<!--                            ipjq('[name="timePost"]').val(info.term);-->
<!--                            orderWidjet.close(); // закроем виджет-->
<!--                        }-->
<!--                    });-->
<!--                </script>-->
<!--                <p> <a href='javascript:void(0)' onclick='orderWidjet.open()'>Выбрать ПВЗ</a> </p>-->
<!--                <div id="linkForWidjet" style="display: none;">-->
<!--                    <p>Выбран пункт выдачи заказов: <input type='text' name='chosenPost' value=''/></p>-->
<!--                    <p>Адрес пункта: <input type='text' name='addresPost' value=''/></p>-->
<!--                    <p>Стоимость доставки: <input type='text' name='pricePost' value=''/></p>-->
<!--                    <p>Примерные сроки доставки: <input type='text' name='timePost' value=''/></p>-->
<!--                </div>-->
<!--            </div>-->

            <div id="payment">
                <h2 class="cart-ones__h2">Оплата</h2>
                <?
                foreach ($payments as $payment) {
                    $payments_arr[$payment->id] = [0 => $payment->name, 1 => $payment->description];
                }
                ?>
                <?=
                $form->field($order, 'payment_id')
                    ->radioList(
                        $payments_arr,
                        [
                            'item' => function($index, $label, $name, $checked, $value) {

                                $return = '<label class="modal-radio payment-radio-' . $value . '">';
                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3"';
                                if ($index === 1) {
                                    $return .= 'checked';
                                }
                                $return .= '>';
                                $return .= '<i></i>';
                                $return .= ' <b>' . ucwords($label[0]) . '</b><br/>';
                                $return .= ' <span>' . ucwords($label[1]) . '</span>';
                                $return .= '</label><br/>';

                                return $return;
                            }
                        ]
                    )
                    ->label(false);
                ?>
            </div>

            <h2 class="cart-ones__h2">Состав заказа</h2>
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
                    <div class="cart-one__col cart-one__col_4 cart-one__col_del" data-id="<?= $id ?>"></div>
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
                <a href="<?= \yii\helpers\Url::to(['cart/index']) ?>" class="btn btn-warning">Вернуться в корзину</a>
            </div>

            <h2 class="cart-ones__h2">Комментарий к заказу</h2>
            <?= $form->field($order, 'comment')
                ->textarea(['rows' => '6', 'placeholder' => "Опишите ваши пожелания при оформлений заказа"])
                ->label(false);?>

            <?= Html::submitButton('Завершить оформление заказа', ['class' => 'cart-ones__btn btn btn-warning']); ?>
            <?php $form = ActiveForm::end(); ?>
        </div>
    </section>
<?php else : ?>
    <div class="orders padding">
        <div class="container">
            <div class="title">
                <h2 class="title__header">Оформление заказов</h2>
                <span class="title__line"><i class="fa fa-car"></i></span>
            </div>
            <?php if (Yii::$app->session->getFlash('success')) : ?>
                <div class="alert alert-success alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php else : ?>
                <h3>Нет оформленных заказов</h3>
            <?php endif ?>
        </div>
    </div>
<?php endif ?>