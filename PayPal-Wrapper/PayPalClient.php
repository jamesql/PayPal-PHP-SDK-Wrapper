<?php
    namespace PayPalWrapper;
    
    require 'vendor/autoload.php';

    use \PayPal\Api\Amount;
    use \PayPal\Api\Details;
    use \PayPal\Api\Item;
    use \PayPal\Api\ItemList;
    use \PayPal\Api\Payer;
    use \PayPal\Api\Payment;
    use \PayPal\Api\RedirectUrls;
    use \PayPal\Api\Transaction;   

    $configclass = new PayPalConfig();
    $glbconfig = $configclass->returnConfig();
    $defaultred = new PayPalRedirect($glbconfig->defaultRedirect, $glbconfig->defaultCancel);

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
            $this_order = new Order($arrayOfItems);

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

    class PayPalRedirect
    {
        public $return;
        public $cancel;

        function __construct($returnurl, $cancelurl)
        {
            $this->return = $returnurl;
            $this->cancel = $cancelurl;
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