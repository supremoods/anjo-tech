<?php
    include('php/config.php');
    include('php/db-config.php');
    include('php/signup-functions.php');

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
                createAccountGoogle($email, $firstname, $avatar);
            }
        }
    }

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
    <div class="form-container">
        <form id="signup-input">
            <p class="back"><</p>
            <input type="text" placeholder="Name" required>
            <br/>
            <input type="Email" placeholder="Email" required>
            <br/>
            <select id="month" name="month">
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
            <select id="day" name="day">
                <option value="0" selected disabled>Day</option>
            </select>
            <select id="year" name="year">
                <option value="0000" selected disabled>Year</option>
                <?php 
                    for ($i=1980; $i <= 2022; $i++) { 
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                ?>
            </select>
            <input id="submit" type="submit" value="Next">
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let month = $("#month");
        let year = $("#year");
        let day = $('#day');
        month.change(function (e) { 
            day.empty();
            day.append('<option value="0" selected disabled>Day</option>');
            if(month.val() == 1 || month.val() == 3 || month.val() == 5 || month.val() == 7 || month.val() == 8 || month.val() == 10 || month.val() == 12){
                for (let i = 1; i <= 31; i++) {
                    day.append('<option value="'+ i +'">'+ i +'</option>');
                }
            } else if (month.val() == 2){
                for (let i = 1; i <= 28; i++) {
                    day.append('<option value="'+ i +'">'+ i +'</option>');
                }
                if (year.val() % 4 == 0){
                    day.append('<option value="29">29</option>');
                }
            } else {
                for (let i = 1; i <= 30; i++) {
                    day.append('<option value="'+ i +'">'+ i +'</option>');
                }
            }
        });

        year.change(function() {
            day.empty();
            day.append('<option value="0" selected disabled>Day</option>');
            if (year.val() % 4 == 0){
                console.log(year.val % 4);
                if(month.val() == 2){
                    console.log(month.val());
                    for (let i = 1; i <= 29; i++) {
                        day.append('<option value="'+ i +'">'+ i +'</option>');
                    }
                }
            } else {
                for (let i = 1; i <= 28; i++) {
                    day.append('<option value="'+ i +'">'+ i +'</option>');
                }
            }
        });
    </script>
    <script src="javascript/signup.js"></script>
</body>
</html>