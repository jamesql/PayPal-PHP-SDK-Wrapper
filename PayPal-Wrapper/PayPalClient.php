<?php
    namespace PayPalWrapper;
    
    require 'vendor/autoload.php';

    class PayPalConfig
    {	
    	private $config;

    	function __construct()
    	{
    		$config_file = file_get_contents(__DIR__ . '\config.json');
    		$this->config = json_decode($config_file);
    	}

    	function returnConfig()
    	{
    		return $this->config;
    	}
    }

    class PayPalClient
    {
    	private $config;
        private $context;
        private $currency;

    	function __construct()
    	{
    		$temp_config = new PayPalConfig();
            $this->config = $temp_config->returnConfig();
            $this->context = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    $this->config->clientid,
                    $this->config->clientsecret
                )
            );
    	}

        function CreateOrder($arrayOfItems)
        {
            $this_order = new Order();

            return $this_order;
        }

        function SendOrder(Order $ord)
        {

        }

        function SendConfig()
        {
            return $this->config;
        }

    }

    class PayPalItem
    {
        private $name;
        private $quantity;
        private $amount;

        function __construct($itemName, $itemQuantity, $itemAmount)
        {
            $this->name = $itemName;
            $this->quantity = $itemQuantity;
            $this->amount = $itemAmount;
        }
    }

    class Order
    {
        private $cart;

        function __construct($arrayOfItems)
        {
            $this->cart = $arrayOfItems;
        }
    }

?>