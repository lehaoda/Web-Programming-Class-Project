<?php
require 'connection.php';
session_start();
if(!isset($_SESSION['username'])){
	header('location: login.php');
}
if(!isset($_SESSION['isadmin']) || $_SESSION["isadmin"]==0){
	header('location: index.php');
}
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
        <script src="js/edit_item_admin_script.js"></script>
    </head>
    <body>
        <div>
          <?php
            require 'header.php';
          ?>
           
          <div class="row">
            <div class="col-3">
              <br>
              <h3>&nbsp;&nbsp;Admin Insert Mode</h3>
            </div>


            <div class="col-8">
            	<br>
            		<form id="form_insert" action="edit_item_admin_operation.php" method="POST">
	            		<div class="col mb-4" >
	                      <div class="card h-100" style="width: 25rem;">
	                        <img src="" class="card-img-top" alt="...">
                          <input type="file" id="fileupload" name="fileupload" accept="image/*">

	                        <div class="card-body">
	                          <h5 class="card-title"><p>Title:&nbsp;&nbsp;<input type="text" name="title" id="title"></p></h5>

	                          <p class="card-text">Price:&nbsp;&nbsp;<input type="text" name="price" id="price" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="$"></p>

	                          <p class="card-text">Category:&nbsp;&nbsp;<input type="text" name="category" id="category"></p>

	                          <p class="card-text">Invnetory:&nbsp;&nbsp;<input type="text" name="inventory" id="inventory"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'></p>

	                          <p class="card-text">Description:&nbsp;&nbsp;<input type="text" name="description" id="description"></p>

	                          <input type="submit" class="btn btn-primary" name="formSubmit" id="update_button" value="Save"/>
	                        </div>
	                      </div>
	                    </div>
	                    
                	</form>
            	<br><br><br><br>
            </div>


            <div class="col-1">
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