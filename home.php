<?php
 include('php/db-config.php');
    session_start();

    if(!isset($_SESSION['user_email'])){
        header('location: signup.php');
    }
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

    global $conn;

    $foo = $_SESSION['user_email'];
            
    $query = mysqli_query($conn, "SELECT * FROM account_user WHERE email = '$foo'");
    $fetch = mysqli_fetch_array($query);
        echo'
            <div class="panel-body">
                <img src="'.$fetch['avatar'].'" class="img-responsive img-circle img-thumbnail"/>
            </div>
            <h3>'.$fetch['name'].'</h3>
            <h3>'.$fetch['email'].'</h3>
            <h3><a href="index.php">Log out</a></h3>
        ';
    ?>
</body>
</html>