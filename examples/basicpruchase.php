<?php
    namespace Demo;
    require 'PayPal-Wrapper\PayPalClient.php';

    // Create a PayPal 'client'
    $client = new \PayPalWrapper\PayPalClient();

    if (array_key_exists('button', $_POST))
        purchase();

    function purchase()
    {
        $order = $GLOBALS["client"]->CreateOrder(array(new \PayPalWrapper\PayPalItem("Some Sort of Item for 50$ (x3)", 3, 50)));
        $GLOBALS["client"]->SendOrder($order, true);
    }
?>

<html>
    <body style="text-align:center;">
        <h1 style="color:blue;"> PayPal SDK Wrapper Demo </h1>
        <form method="post">
            <input type="submit" name="button" value="Buy Apples" />
        </form>
    </body>
</html>