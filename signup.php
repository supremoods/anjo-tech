<?php
    include('php/db-config.php');
    include('php/signup-config.php');
    include('php/signup-functions.php');
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
        <h2>PHP SIGNUP</h2>
        <div class="panel panel-default">
            <?php echo '<a href="'.$google_client->createAuthUrl().'">Sign up with Google</a>';?>
            <p>or</p>
            <button id="sign-up-button">Sign up with Phone or Email</button>
        </div>
    </div>
    <div class="form-container-input">
        <form id="signup-input">
            <p onclick="hideModal(0)" class="back"><</p>
            <input id="name" type="text" placeholder="Name" required>
            <br/>
            <input id="email" type="Email" placeholder="Email" required>
            <br/>
            <select id="month" name="months">
                <option value="0" selected disabled>Month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3" >March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <select id="day" name="days">
                <option value="0" selected disabled>Day</option>
            </select>
            <select id="year" name="years">
                <option value="0000" selected disabled>Year</option>
                <?php 
                    for ($i=1980; $i <= 2022; $i++) { 
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                ?>
            </select>
            <input id="submit" name="submit" type="submit" value="Next">
        </form>
        
    </div>
    <div class="form-container-verify">
        
    </div>
    <div id="update"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="javascript/signup.js"></script>
</body>
</html>