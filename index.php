<?php
    namespace Demo;
    require '\PayPal-Wrapper\PayPalClient.php';

    $client = new \PayPalWrapper\PayPalClient();

    echo $client->SendConfig();
?>