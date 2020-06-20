<?php
    namespace PayPalWrapper;
    
    require 'vendor/autoload.php';

    $config_file = file_get_contents("./config.json");
    $config = json_decode($config_file, true);

    class PayPalClient
    {
        function CreateOrder()
        {
            $this_order = new Order();

            return $this_order;
        }

        function SendOrder(Order $ord)
        {

        }

        function SendConfig()
        {
            return $config;
        }

    }

    class Order
    {
        function Order()
        {

        }
    }

?>