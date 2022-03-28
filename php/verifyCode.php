<?php
    include('db-config.php');
    @session_start();

    if(isset($_POST['vcode'])){
        $code = $_POST['vcode'];
        $raw_email = $_SESSION['foo_user_email'];
        $query = mysqli_query($conn, "SELECT * FROM account_signup_verification WHERE user_email='$raw_email'");

        if(mysqli_num_rows($query) != 0) {
            $data = mysqli_fetch_array($query);
            $db_code = $data['verification_code'];
            if($code == $db_code){
                $_SESSION['user_email'] =  $_SESSION['foo_user_email'];
                echo '<script>window.location.href="http://localhost/home.php"</script>';
            } else {
                echo 'Wrong verification code';
            }
        } else {
            echo 'Error';
        }
    }

?>