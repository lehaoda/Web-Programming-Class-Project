<?php 
  require 'connection.php';
  session_start();
  //check username
  if (isset($_POST['username_check'])) {
  	$username = $_POST['username'];
  	$sql = "SELECT * FROM Users WHERE username='$username'";
  	$results = mysqli_query($conn, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "taken";	
  	}else{
  	  echo 'not_taken';
  	}
  	exit();
  }

  //check email
  if (isset($_POST['email_check'])) {
  	$email = $_POST['email'];
  	$sql = "SELECT * FROM Users WHERE email='$email'";
  	$results = mysqli_query($conn, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "taken";	
  	}else{
  	  echo 'not_taken';
  	}
  	exit();
  }

  //save
  if (isset($_POST['save'])) {
  	$username = $_POST['username'];
  	$email = $_POST['email'];
  	$password = $_POST['password'];
  	$sql = "SELECT * FROM Users WHERE username='$username'";
  	$results = mysqli_query($conn, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "exists";	
  	  exit();
  	}else{
      $query = "INSERT INTO users (username, email, password, isadmin) VALUES ('$username', '$email', '".md5($password)."','0')";
      if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $query . "" . mysqli_error($conn);
      }
  	  exit();
  	}
  }

  //login, check credential
  if (isset($_POST['credential'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM Users WHERE username='$username' AND password='".md5($password)."'";
    $results = mysqli_query($conn, $sql);
    if (mysqli_num_rows($results) > 0) {
      echo 'valid user';
      $row=mysqli_fetch_array($results);
      $_SESSION['username']=$row['username'];
      $_SESSION['email']=$row['email'];
      $_SESSION['isadmin']=$row['isadmin'];
      exit();
    }else{
      echo "invalid username or password";
      exit();
    }
  }

?>