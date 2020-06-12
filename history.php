<?php
require 'connection.php';
//require 'cart_operation.php';
session_start();
if(!isset($_SESSION['username'])){
  header('location: login.php');
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
    </head>
    <body>
        <div>
          <?php
            require 'header.php';
          ?>
           
          <div class="row">
            <div class="col-2">
              <br>
              <h2>&nbsp;&nbsp;History</h2>
            </div>


            <div class="col-8">
              <br>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Purchase Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $sql = "SELECT * FROM History WHERE username='".$_SESSION['username']."' ORDER BY purchase_date DESC";
                  $results = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($results) > 0) {
                    while($record = mysqli_fetch_array($results)){ 
                      $query_item = "SELECT * FROM Products WHERE title='".$record['title']."'";
                      $items = mysqli_query($conn, $query_item);
                      if(mysqli_num_rows($items) == 0){
                        continue;
                      }
                      $item = mysqli_fetch_array($items);
                      ?>
                      <tr>
                        <td><?php echo $item['title'] ?></td>
                        <td><?php echo $item['price'] ?></td>
                        <td><?php echo $record['quantity'] ?></td>
                        <td><?php echo $record['purchase_date'] ?></td>
                      </tr>
                    <?php
                    }
                  }?>
                </tbody>
              </table>
              <br><br><br><br>
            </div>


            <div class="col-2">
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