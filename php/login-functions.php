<?php
    include('db-config.php');

    function loginAccount($user_email){
        global $conn;
        
        $query = mysqli_query($conn, "SELECT * FROM account_user WHERE email = '$user_email'");
        $count = mysqli_num_rows($query);
        if($count){
            @session_start();
            $_SESSION['foo_user_email'] = $user_email;
            echo '<script>window.location.href="http://localhost/authentication.php"</script>';

        } else {
            echo 'The email is not existed';
            echo '<script>
                alert("The email is not existed"); 
                window.location.href="http://localhost/login.php";
            </script>';
        }    
    }

    if(isset($_GET["code"])){
        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
        if(!isset($token['error'])){
            $google_client->setAccessToken($token['access_token']);

            $_SESSION['access_token'] = $token['access_token'];

            $google_service = new Google_Service_Oauth2($google_client);

            $data = $google_service->userinfo_v2_me->get();
            
            if(!empty($data['given_name'])){
                $email = $data['email'];
                loginAccount($email);
            }
        }
    }




?>