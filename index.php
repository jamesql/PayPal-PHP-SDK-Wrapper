<?php
    namespace Demo;
    require 'PayPal-Wrapper\PayPalClient.php';

    $client = new \PayPalWrapper\PayPalClient();
    $config = $client->SendConfig();

    echo $config->clientid;

        function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
      }
      console_log($client->SendConfig()->clientid);
?>