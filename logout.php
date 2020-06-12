<?php
	session_start();
	session_unset();
	session_destroy();
	//header("Location:index.php");
	//exit();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="shortcut icon" href="img/icon.png" />
        <title>Hunting Products</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div> 
            <?php
                require 'header.php';
            ?>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                    	<p>You have been logged out. <a href="login.php">Login again.</a></p>
                    </div>
                </div>
            </div>

           <footer class="footer"> 
               <div class="container">
               <center>
                   <p>Copyright &copy UTD Hunting Store. All Rights Reserved.</p>
                   <p>Developed by Haoda LE & Yuer Jiang</p>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>