<?php
    include('db-config.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    function verifyEmail($recipient, $code){
        global $mail;
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = '0.kitagawa.marin.0@gmail.com';                     //SMTP username
            $mail->Password   = 'Supremo25';                               //SMTP password
            $mail->SMTPSecure = "tls";            
            $mail->SMTPAutoTLS = false;
            $mail->Port       = 587;                                   

            //Recipients
            $mail->setFrom('0.kitagawa.marin.0@gmail.com', 'JOHN LAPPUS');
            $mail->addAddress($recipient);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'JOHN LAPPAY: Verification Code';
            $mail->Body    = 'Verification Code:'. $code;
            $mail->AltBody = 'Verification Code:'. $code;

            $mail->send();
            echo 'Email has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function createAccount($user_email, $user_username, $user_fname, $user_avatar){
        global $conn;
        @session_start();
        $_SESSION['user_first_name'] = $user_fname;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_image'] = $user_avatar;
        $query = mysqli_query($conn, "SELECT * FROM account_user WHERE email = '$user_email'");
        $count = mysqli_num_rows($query);
        if(!$count){
            $uid = uniqid('u');
            $query = mysqli_query($conn, "INSERT INTO `account_user`(`id`, `unique_id`, `name`, `username`, `email`, `avatar`) VALUES (NULL,'$uid','$user_fname', '$user_username','$user_email','$user_avatar')") or die(mysqli_error($conn));
            
            if($query){
                echo '<script>window.location.href="http://localhost/lappus_tech/home.php"</script>';
            }else{
                echo "Failed.";
            }
        } else {
            echo '<script>window.location.href="http://localhost/lappus_tech/home.php"</script>';
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
                $firstname = $data['given_name'];
                $avatar = $data['picture']; 
                createAccount($email, NULL, $firstname, $avatar);
            }
        }
    }

    if(isset($_POST['user_email'])){
        $raw_email = $_POST['user_email'];
        $ver_code = random_int(100000, 999999);

        $query = mysqli_query($conn, "SELECT email FROM account_user WHERE email='$raw_email'");

        if(mysqli_num_rows($query) != 0){
                echo 'User already exist. Proceed to <a href="login.php">Login</a>';
        } else {
            $form= '';
            echo '
                <script>
                let form = $(".form-container-verify");
                let formContent= "<div id=\"verify-input\" >" +
                                    "<p id=\"verification-respond\"></p>" +
                                    "<p onclick=\"hideModal(1)\" class=\"back\"><</p>" +
                                    "<input type=\"text\" id=\"code\" placeholder=\"Verification Code\" required >" +
                                    "<input type=\"submit\" onclick=\"verifySubmit()\" name=\"verify-submit\" id=\"verify-submit\" value=\"Verify\">" +
                                "</div>";
                form.append(formContent);
                form.show();
                </script>'
                ;
            $query = mysqli_query($conn, "SELECT user_email FROM account_signup_verification WHERE user_email='$raw_email'");
            if(mysqli_num_rows($query) != 0) {
                $update = mysqli_query($conn, "UPDATE account_signup_verification SET verification_code='$ver_code' WHERE user_email='$raw_email'");
            } else {
                $update = mysqli_query($conn, "INSERT INTO `account_signup_verification`(`id`, `user_email`, `verification_code`) VALUES (NULL,'$raw_email', $ver_code)");
            }
    
            if($update) {
                verifyEmail($raw_email, $ver_code);
                echo 'We e-mailed you a verification code';
            } else {
                echo 'Something went wrong';
            }
        }
    }

    if(isset($_POST['vcode'])){
        $code = $_POST['vcode'];
        $raw_email = $_POST['email_user'];
        $raw_username = $_POST['name'];
        $query = mysqli_query($conn, "SELECT * FROM account_signup_verification WHERE user_email='$raw_email'");

        if(mysqli_num_rows($query) != 0) {
            $data = mysqli_fetch_array($query);
            $db_code = $data['verification_code'];
            if($code == $db_code){
                createAccount($raw_email, $raw_username, NULL, "../lappus_tech//assets/images/default-avatar.jpg");
            } else {
                echo 'Wrong verification code';
            }
        } else {
            echo 'Error';
        }

    }

?>