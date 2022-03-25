<?php    
    require_once 'vendor/autoload.php';

    $google_client = new Google_Client();

    $google_client->setClientId('115985278158-2gknr41opffrupao6236mj8nsgnbk9rk.apps.googleusercontent.com');

    $google_client->setClientSecret('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');

    $google_client->setRedirectUri('http://localhost/signup.php');

    $google_client->addScope('email');
    $google_client->addScope('profile');

    session_start();
?>
