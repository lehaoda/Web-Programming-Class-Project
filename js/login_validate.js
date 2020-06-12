$('document').ready(function(){
 var username_state = false;
 var password_state = false;

//check if username is null
 $('#username').on('blur', function(){
  var username = $('#username').val();
  if (username == '' || username == null) {
  	username_state = false;
    $('#username').parent().removeClass();
    $('#username').parent().addClass("form_error");
    $('#username').siblings("span").text('Username cannot be null');
  	return;
  }else{
    username_state = true;
    $('#username').parent().removeClass();
    $('#username').siblings("span").text('');
  }
});

//check if password is null
  $('#password').on('blur', function(){
  var password = $('#password').val();
  if (password == '' || password == null) {
    password_state = false;
    $('#password').parent().removeClass();
    $('#password').parent().addClass("form_error");
    $('#password').siblings("span").text('Password cannot be null');
    return;
  } else {
    password_state = true;
    $('#password').parent().removeClass();
    $('#password').siblings("span").text('');
  }
});

//check user credential in sql
 $('#reg_btn').on('click', function(){
 	var username = $('#username').val();
 	var password = $('#password').val();
 	if (username_state == false || password_state == false) {
	  $('#error_msg').text('Please fill in valid data first');
	}else{
      // proceed with form submission
      $.ajax({
      	url: 'register.php',
      	type: 'POST',
      	data: {
          'credential' : 1,
      		'username' : username,
      		'password' : password,
      	},
      	success: function(response){
          if(response != 'valid user'){
            $('#error_msg').text(response);
            $('#username').val('');
            $('#password').val('');
            username_state = false;
            password_state = false;
          }
          else{
            //alert(response);
            window.location.replace('products.php');
          }
          
      	}
      });
 	}
 });
});