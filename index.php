<?php
    include('php/config.php');

    $loginButton = "";

    if(isset($_GET["code"])){
        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

        if(!isset($token['error'])){
            $google_client->setAccessToken($token['access_token']);

            $_SESSION['access_token'] = $token['access_token'];

            $google_service = new Google_Service_Oauth2($google_client);

            $data = $google_service->userinfo->get();

            if(!empty($data['given_name'])){
                $_SESSION['user_first_name'] = $data['given_name'];
            }

            if(!empty($data['family_name'])){
                $_SESSION['user_last_name'] = $data['family_name'];
            }

            if(!empty($data['email'])){
                $_SESSION['user_email_address'] = $data['email'];
            }

            if(!empty($data['gender'])){
                $_SESSION['user_gender'] = $data['gender'];
            }

            if(!empty($data['picture'])){
                $_SESSION['user_image'] = $data['picture'];
            }
        }
    }

    if(!isset($_SESSION['access_token'])){
        $loginButton = '<a href="'.$google_client->createAuthUrl().'">LOGIN</a>';
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Login</title>
</head>
<body>
    <div class="container">
        <h2>PHP LOGIN</h2>

        <div class="panel panel-default">
            <?php

                if($loginButton == ""){
                    echo'
                        <div class="panel-heading">WELCOME USER</div>
                        <div class="panel-body">
                            <img src="'.$_SESSION['user_image'].'" class="img-responsive img-circle img-thumbnail"/>
                        </div>
                        <h3>'.$_SESSION['user_first_name'].'</h3>
                        <h3><a href="php/logout.php">Log out</a></h3>
                    ';
                } else {
                    echo '
                        <div align="center">'.$loginButton.'</div>
                    ';
                }

            ?>
        </div>
    </div>
</body>
</html>