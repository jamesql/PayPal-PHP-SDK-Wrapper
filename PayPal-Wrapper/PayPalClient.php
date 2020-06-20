<?php
    namespace PayPalWrapper;
    
    require 'vendor/autoload.php';

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

    }

    class Order
    {
        function Order()
        {

        }
    }

?>