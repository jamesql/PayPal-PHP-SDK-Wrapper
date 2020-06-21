<?php
    namespace Demo;
    require 'PayPal-Wrapper\PayPalClient.php';

    // Create a PayPal 'client'
    $client = new \PayPalWrapper\PayPalClient();

    // Create a order for a Apple ($5) x 3 (Name, Quantity, Price)
    $order = $client->CreateOrder(array(new \PayPalWrapper\PayPalItem("Apple", 3, 5)));
    
    // Send the order to user, true is to automatically redirect, this function returns the url to send the user to.
    $redirecturl = $client->SendOrder($order, true);
?>