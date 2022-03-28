
<?php
    include('php/db-config.php');
    include('php/login-config.php');
    include('php/login-functions.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Login</title>
    <link rel="stylesheet" href="styles/signup.css">
   
</head>
<body>
    <div class="container">
        <h2>PHP SIGNIN</h2>
        <div class="panel panel-default">
            <?php echo '<a href="'.$google_client->createAuthUrl().'">Login with Google</a>';?>
            <p>or</p>
            <button id="sign-in-button">Login  with Phone or Email</button>
        </div>
    </div>
    <div class="form-container-input">
        <form id="sign-in-input">
            <input id="email" type="Email" placeholder="Email" required>
            <br/>
            <input id="password" type="Password" placeholder="Password" required>
            <br/>
            <input id="submit" name="submit" type="submit" value="Next">
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="javascript/signup.js">
    </script>
</body>
</html>