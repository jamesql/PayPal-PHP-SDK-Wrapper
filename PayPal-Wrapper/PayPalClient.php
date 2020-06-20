<?php
    namespace PayPalWrapper;
    
    require 'vendor/autoload.php';

    class PayPalConfig
    {	
    	private $config;

    	function __construct()
    	{
    		$config_file = file_get_contents(__DIR__ . '\config.json');
    		$this->config = json_decode($config_file, true);
    	}

    	function returnConfig()
    	{
    		return $this->config;
    	}
    }

    class PayPalClient
    {
    	private $config;

    	function __construct()
    	{
    		$temp_config = new PayPalConfig();
    		$this->config = $temp_config->returnConfig();
    	}

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
            return $this->config;
        }

    }

    class Order
    {
        function Order()
        {

        }
    }

?>