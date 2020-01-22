<?php
    include_once("libs/XenditPHPClient.php");
    define('SECRET_API_KEY', 'xnd_development_2l1SxCJvrhJAHbXdL1Rixrxia7Qd0ls6lUyZMnkm5FWgVD7aqYREGfbsrmFTgru1');

    $options['secret_api_key'] = constant('SECRET_API_KEY');
    $xenditPHPClient = new XenditClient\XenditPHPClient($options);
    
    $external_id = 'demo_1475801962607';
    $amount = 230000;
    $payer_email = 'sample_email@xendit.co';
    $description = 'Trip to Bali';
    // $options['callback_virtual_account_id'] = '123456';
    $response = $xenditPHPClient->createInvoice($external_id, $amount, $payer_email, $description);

    echo '<pre>';
    print_r($response);
    echo '</pre>';