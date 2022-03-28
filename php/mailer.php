<?php

include('db-config.php');
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
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
    @session_start();

    if(isset($_SESSION['foo_user_email'])){
        $raw_email = $_SESSION['foo_user_email'];
        $ver_code = random_int(100000, 999999);

        $query = mysqli_query($conn, "SELECT user_email FROM account_signup_verification WHERE user_email='$raw_email'");

        if(mysqli_num_rows($query) != 0) {
            $update = mysqli_query($conn, "UPDATE account_signup_verification SET verification_code='$ver_code' WHERE user_email='$raw_email'");
        }else {
            $update = mysqli_query($conn, "INSERT INTO `account_signup_verification`(`id`, `user_email`, `verification_code`) VALUES (NULL,'$raw_email', $ver_code)");
        }

        if($update) {
            verifyEmail($raw_email, $ver_code);
            echo '<p>We e-mailed you a verification code</p>';
        } else {
            echo '<p>Something went wrong</p>';
        }
            
    }


    

?>