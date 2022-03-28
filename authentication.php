<?php
      include('php/db-config.php');
      @session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth</title>
    <link rel="stylesheet" href="styles/signup.css">

</head>
<body>
   
    <div id="auth" class="form-container-verify">
        <div id="verify-input" >
            <p id="verification-respond"></p>
            <p onclick="hideModal(1)" class="back"></p>
            <input type="text" id="code" placeholder="Verification Code" required >
            <input type="submit" onclick="verifyAccountSubmit()" name="verify-submit" id="verify-submit" value="Verify">   
        </div>
        <?php
            include_once("php/mailer.php");
        ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="javascript/signup.js">
    </script>
    <script>
       $("#auth").css("display", "block");
    </script>
</body>
</html>