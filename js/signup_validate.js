$('document').ready(function(){
 var username_state = false;
 var email_state = false;
 var password_state = false;

//check username format
 $('#username').on('blur', function(){
  var username = $('#username').val();
  if (username == '' || username == null) {
  	username_state = false;
    $('#username').parent().removeClass();
    $('#username').parent().addClass("form_error");
    $('#username').siblings("span").text('Username cannot be null');
  	return;
  }else if(!username.match(/^[0-9a-zA-Z]+$/)){
    $('#username').parent().removeClass();
    $('#username').parent().addClass("form_error");
    $('#username').siblings("span").text('Username can only be digits and characters');
    return;
  }
//check exist username
  $.ajax({
    url: 'register.php',
    type: 'POST',
    data: {
    	'username_check' : 1,
    	'username' : username,
    },
    success: function(response){
      if (response == 'taken' ) {
      	username_state = false;
      	$('#username').parent().removeClass();
      	$('#username').parent().addClass("form_error");
      	$('#username').siblings("span").text('Username already exist');
      }else if (response == 'not_taken') {
      	username_state = true;
      	$('#username').parent().removeClass();
      	$('#username').parent().addClass("form_success");
      	$('#username').siblings("span").text('Username available');
      }
    }
  });
 });		

 //check email format
  $('#email').on('blur', function(){
 	var email = $('#email').val();
 	if (email == '' || email == null) {
 		email_state = false;
    $('#email').parent().removeClass();
    $('#email').parent().addClass("form_error");
    $('#email').siblings("span").text('Email cannot be null');
 		return;
 	}else if(!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/)){
    $('#email').parent().removeClass();
    $('#email').parent().addClass("form_error");
    $('#email').siblings("span").text('please enter valid email');
    return;
  }
//check exist email
 	$.ajax({
      url: 'register.php',
      type: 'POST',
      data: {
      	'email_check' : 1,
      	'email' : email,
      },
      success: function(response){
      	if (response == 'taken' ) {
          email_state = false;
          $('#email').parent().removeClass();
          $('#email').parent().addClass("form_error");
          $('#email').siblings("span").text('Email already exist');
      	}else if (response == 'not_taken') {
      	  email_state = true;
      	  $('#email').parent().removeClass();
      	  $('#email').parent().addClass("form_success");
      	  $('#email').siblings("span").text('Email available');
      	}
      }
 	});
 });

//check password format
  $('#password').on('blur', function(){
  var password = $('#password').val();
  if (password == '' || password == null) {
    password_state = false;
    $('#password').parent().removeClass();
    $('#password').parent().addClass("form_error");
    $('#password').siblings("span").text('Password cannot be null');
    return;
  } else if (password.length<6){
    password_state = false;
    $('#password').parent().removeClass();
    $('#password').parent().addClass("form_error");
    $('#password').siblings("span").text('Password should be at least 6 characters');
    return;
  } else {
    password_state = true;
    $('#password').parent().removeClass();
    $('#password').parent().addClass("form_success");
    $('#password').siblings("span").text('Password available');
  }
});

//create user if all data is valid.
 $('#reg_btn').on('click', function(){
 	var username = $('#username').val();
 	var email = $('#email').val();
 	var password = $('#password').val();
 	if (username_state == false || email_state == false || password_state == false) {
	  $('#error_msg').text('Please fill in valid data first');
	}else{
      // proceed with form submission
      $.ajax({
      	url: 'register.php',
      	type: 'POST',
      	data: {
      		'save' : 1,
      		'email' : email,
      		'username' : username,
      		'password' : password,
      	},
      	success: function(response){
      		alert(response);
      		$('#username').val('');
      		$('#email').val('');
      		$('#password').val('');
          username_state = false;
          email_state = false;
          password_state = false;
      	}
      });
 	}
 });
});