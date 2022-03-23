$('.back').click(function (e) { 
    $('.form-container').hide();    
});

$('#sign-up-button').click(function (e) { 
    $('.form-container').show();    
});

$('#signup-input').submit(function (e) { 
    e.preventDefault();
});