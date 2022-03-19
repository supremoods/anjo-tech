<?php    
    require_once './vendor/autoload.php';

    $google_client = new Google_Client();

    $google_client->setClientId('1058078009168-vs3peh59ojmu9q18eb16rc557dslgcc7.apps.googleusercontent.com');

    $google_client->setClientSecret('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');

    $google_client->setRedirectUri('http://localhost/index.php');

    $google_client->addScope('email');
    $google_client->addScope('profile');
    session_start();
?>
