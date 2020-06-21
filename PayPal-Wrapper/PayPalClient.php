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

        function SendOrder(Order $ord, $redirect=false)
        {
            $ord->payment->create($this->context);
            $approval = $ord->payment->getApprovalUrl();

            if ($redirect)
                header("Location: " . $approval);

            return $approval;
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

        function getRedirects()
        {
            $this_red = new RedirectUrls();
            $this_red->setReturnUrl($this->return)
                    ->setCancelUrl($this->cancel);
            return $this_red;
        }
    }

    class PayPalItem
    {
        public $name;
        public $quantity;
        public $amount;
        public $total;

        function __construct($itemName, $itemQuantity, $itemAmount)
        {
            $this->name = $itemName;
            $this->quantity = $itemQuantity;
            $this->amount = $itemAmount;
            $this->total = $itemAmount * $itemQuantity;
        }
    }

    class Order
    {
        public $cart;
        public $payer;
        public $red;
        public $itemlist;
        public $details;
        public $amount;
        public $payment;
        public $itemsamount;

        function __construct($arrayOfItems)
        {
            $this->payer = new Payer();
            $this->payer->setPaymentMethod("paypal");

            $this->itemlist = new ItemList();

            $this->cart = $arrayOfItems;
            $this->itemsamount = 0.0;
            foreach ($this->cart as $thisitem)
            {
                $this->itemsamount += $thisitem->total;
                $itemobj = new Item();
                $itemobj->setName($thisitem->name)
                        ->setCurrency($glbconfig->currency)
                        ->setQuantity($thisitem->quantity)
                        ->setPrice($thisitem->amount);
                        
                $this->itemlist->addItem($itemobj);
            }
        }
    }

?>