<?php

    include('php/config.php');
    include('php/db-config.php');
    include('php/signup-google.php');

    $loginButton = "";

    if(isset($_GET["code"])){
        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

        if(!isset($token['error'])){
            $google_client->setAccessToken($token['access_token']);

            $_SESSION['access_token'] = $token['access_token'];

            $google_service = new Google_Service_Oauth2($google_client);

            $data = $google_service->userinfo_v2_me->get();
            
            if(!empty($data['given_name'])){

                $email = $data['email'];
                $firstname = $data['given_name'];
                $lastname = $data['family_name'];
                $avatar = $data['picture']; 
                $_SESSION['user_first_name'] = $firstname;
                $_SESSION['user_last_name'] = $lastname;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_image'] = $avatar;
                $query = mysqli_query($conn, "SELECT * FROM account_user WHERE email = '$email'");
                $count = mysqli_num_rows($query);

                if(!$count){
                    $uid = uniqid('u');
                    $query = mysqli_query($conn, "INSERT INTO `account_user`(`id`, `unique_id`, `firstname`, `lastname`, `email`, `avatar`) VALUES (NULL,'$uid','$firstname','$lastname','$email','$avatar')") or die(mysqli_error($conn));
                    
                    if($query){
                        header ("location:../home.php");
                    }else{
                        echo "Failed.";
                    }
                } else {
                    header ("location:../home.php");
                }
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