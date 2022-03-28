const months = $("#months");
const years = $("#years");
const days = $('#days');
let toggle = 0;
months.change(function (e) { 
    days.empty();
    days.append('<option value="0" selected disabled>days</option>');
    if(months.val() == 1 || months.val() == 3 || months.val() == 5 || months.val() == 7 || months.val() == 8 || months.val() == 10 || months.val() == 12){
        for (let i = 1; i <= 31; i++) {
            days.append('<option value="'+ i +'">'+ i +'</option>');
        }
    } else if (months.val() == 2){
        for (let i = 1; i <= 28; i++) {
            days.append('<option value="'+ i +'">'+ i +'</option>');
        }
        if (years.val() % 4 == 0){
            days.append('<option value="29">29</option>');
        }
    } else {
        for (let i = 1; i <= 30; i++) {
            days.append('<option value="'+ i +'">'+ i +'</option>');
        }
    }
});

years.change(function() {
    days.empty();
    days.append('<option value="0" selected disabled>days</option>');
    if (years.val() % 4 == 0){
        console.log(years.val % 4);
        if(months.val() == 2){
            console.log(months.val());
            for (let i = 1; i <= 29; i++) {
                days.append('<option value="'+ i +'">'+ i +'</option>');
            }
        }
    } else {
        for (let i = 1; i <= 28; i++) {
            days.append('<option value="'+ i +'">'+ i +'</option>');
        }
    }
});

function hideModal(e){
    if (e == 0){
        toggle = 0;
    } else {
        toggle = 1;
    }
    $('.form-container-input').hide();
    $('.form-container-verify').hide();   
}

$('#sign-up-button').click(function (e) { 
    if (toggle == 0){
        $('.form-container-input').show();    
    } else {
        $('.form-container-verify').show();    
    }
});

$('#signup-input').submit(function (e) { 
    e.preventDefault();
    let email = $('#email').val();
    let name = $('#name').val();
    $('.form-container-input').hide();
    $('#update').load("../php/signup-functions.php", {
        user_email: email,
        name: name
    });
});


$('#login-in-google').click(function (e) { 
    $('.form-container-verify').load("../php/createAuthUrl.php");
});
function verifySubmit() {
    let code = $("#code").val();
    let name = $('#name').val();
    let email = $('#email').val();
    $('#verification-respond').load("../php/signup-functions.php", {
        vcode: code,
        email_user: email,
        name: name
    });
}

function verifyAccountSubmit() {
    let code = $("#code").val();
    $('#verification-respond').load("../php/verifyCode.php", {
        vcode: code
    });
}



      
