<?php
    include('db-config.php');

    function createAccountGoogle($user_email, $user_fname, $user_avatar){
        global $conn;
        $_SESSION['user_first_name'] = $user_fname;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_image'] = $user_avatar;
        $query = mysqli_query($conn, "SELECT * FROM account_user WHERE email = '$user_email'");
        $count = mysqli_num_rows($query);
        if(!$count){
            $uid = uniqid('u');
            $query = mysqli_query($conn, "INSERT INTO `account_user`(`id`, `unique_id`, `name`, `email`, `avatar`) VALUES (NULL,'$uid','$user_fname','$user_email','$user_avatar')") or die(mysqli_error($conn));
            
            if($query){
                header ("location:../home.php");
            }else{
                echo "Failed.";
            }
        } else {
            header ("location:../home.php");
        }
    }

?>