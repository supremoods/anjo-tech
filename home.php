<?php

    session_start();

    // if(!isset($_SESSION['user_email_address'])){
    //     header('location: signup.php');
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HOME.php</h1>
    <?php
        echo'
            <div class="panel-body">
                <img src="'.$_SESSION['user_image'].'" class="img-responsive img-circle img-thumbnail"/>
            </div>
            <h3>'.$_SESSION['user_first_name'].'</h3>
            <h3>'.$_SESSION['user_last_name'].'</h3>
            <h3>'.$_SESSION['user_email'].'</h3>
            <h3><a href="php/logout.php">Log out</a></h3>
        ';
    ?>
</body>
</html>