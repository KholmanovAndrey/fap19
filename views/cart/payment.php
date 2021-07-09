<?// echo '<pre>';var_dump($order, true);echo '</pre>'; ?>
<section class="cart-ones padding">
    <div class="container">
        <div class="title">
            <h1 class="title__header">Оформление заказов</h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>
        <div class="payment">
            <?php
            $client_login = $order->name;
            $orderid = $order->id;
            $order_sum = $order->sum;
            $optional_phone = $order->phone;

            $payment_parameters = http_build_query(array( "clientid"=>$client_login,
                "orderid"=>$orderid,
                "sum"=>$order_sum,
                "client_phone"=>$optional_phone));
            $options = array("http"=>array(
                "method"=>"POST",
                "header"=>
                    "Content-type: application/x-www-form-urlencoded",
                "content"=>$payment_parameters
            ));
            $context = stream_context_create($options);

            echo file_get_contents("https://fap19.server.paykeeper.ru/order/inline/",FALSE, $context);
            # Вместо demo.paykeeper.ru нужно указать адрес вашего сервера paykeeper
            ?>
        </div>
    </div>
</section>
