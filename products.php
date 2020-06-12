<?php
require 'connection.php';
require 'cart_operation.php';
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
        <script src="js/cart_operation_script.js"></script>
    </head>
    <body>
        <div>
          <?php
            require 'header.php';
          ?>
           
          <div class="row">
            <!--show category and search filter conditions-->
            <div class="col-3">
              <br>
              <h2>&nbsp;&nbsp;Shopping</h2>

              <div class="container my-4">
                <hr>
                <p class="font-weight-bold">Category</p>

                <form action="products.php" method="POST">
                  <ul class="list-group list-group-flush">

                  <?php
                    //list all categories with check box
                    $query_category="SELECT DISTINCT(category) FROM Products";
                    $results_category=mysqli_query($conn, $query_category);

                    while($category = mysqli_fetch_array($results_category)){
                  ?>
                      <li class="list-group-item">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" name="categories[]" class="custom-control-input" id="<?php echo $category['category'] ?>" value="<?php echo $category['category'] ?>"
                          <?php
                            if(in_array($category['category'], $_POST["categories"])){
                           ?>
                              checked
                           <?php   
                            }else{
                           ?>
                              unchecked
                           <?php   
                            }
                           ?>
                          >
                          <label class="custom-control-label" for="<?php echo $category['category'] ?>"><?php echo $category['category'] ?></label>
                        </div>
                      </li>
                  <?php
                    }
                  ?>
                  </ul>
                  <br>
                  <input type="text" name="search" value="<?php echo $_POST['search'] ?>" />
                  <input type="submit" class="btn btn-secondary btn-sm" name="formSubmit" value="Filter" />
                </form>
                
              </div>
            </div>

            <!--show the filtered products with paging-->
            <div class="col-8">
              <br>
              <div class="row row-cols-1 row-cols-md-3">

              <?php
                $cards_per_page=6;
                $sql = "SELECT * FROM Products";

                if(isset($_POST["categories"])){
                  $categories=$_POST["categories"];
                  if(!empty($categories)){
                    //echo "no category selected";
                    $N=count($categories);
                    $sql_cat=" WHERE (";
                    for($i=0; $i<$N; $i++){
                      if($i!=0){
                        $sql_cat.=" OR ";
                      }
                      $sql_cat.="category='$categories[$i]'";
                    }
                    $sql.=$sql_cat.")";
                  }
                }

                if(isset($_POST["search"])){
                  $search=$_POST["search"];
                  if($search!="" && $search!=null){
                    $sql_search="";
                    if(isset($_POST["categories"]) && !empty($_POST["categories"])){
                      $sql_search.=" AND title LIKE '%".$search."%'";
                    }else{
                      $sql_search.=" WHERE title LIKE '%".$search."%'";
                    }
                  }
                  $sql.=$sql_search;
                }
                //echo $sql;

                $results = mysqli_query($conn, $sql);
                if (mysqli_num_rows($results) == 0) {
                  echo "no product found";
                }else{
                  $num_products=mysqli_num_rows($results);
                  $num_page=ceil($num_products/$cards_per_page);

                  $start_no=!isset($_GET['page'])?0:($num_page==1?0:((int)$_GET['page']-1)*$cards_per_page);
                  $sql_paged=$sql." LIMIT $start_no, $cards_per_page";
                  //echo $sql_paged;
                  //$sql_paged = "SELECT * FROM Products LIMIT $start_no, $cards_per_page";
                  $results_paged = mysqli_query($conn, $sql_paged);
                  
                  while($record = mysqli_fetch_array($results_paged)){ 
              ?>
                    <div class="col mb-4" >
                      <div class="card h-100">
                        <img src="<?php echo $record["image"]; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $record["title"]; ?></h5>
                          <p class="card-text"><?php echo $record["price"]. "<br>inventory:". $record["inventory"]; ?></p>

                          <?php 
                            if(check_if_added_to_cart($record["title"])){?>
                              <a class="btn btn-secondary" name="<?php echo $record["title"]; ?>" onclick="add_to_cart(this)">Added</a>
                            <?php
                            }else{
                            ?>
                              <a class="btn btn-primary" name="<?php echo $record["title"]; ?>" onclick="add_to_cart(this)">Add to Cart</a>
                            <?php
                            }
                            if(isset($_SESSION["isadmin"]) && $_SESSION["isadmin"]==1){
                            ?>
                              <br><br>
                              <a class="btn btn-warning" name="" href="edit_item_admin.php?title=<?php echo $record['title']; ?>">Edit</a>
                              <a class="btn btn-danger" name="" onclick="$(this).parent().parent().remove()">Delete</a>
                            <?php
                            }
                            ?>
                          
                        </div>
                      </div>
                    </div>
                  <?php
                  }
                }?>
              </div>
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <?php
                    for($i=1; $i<=$num_page; $i++){     
                      echo '<li class="page-item"><a class="page-link" href="products.php?page='.$i.'">'.$i.'</a></li>';
                    }
                  ?>
                </ul>
              </nav>
              <br><br><br><br>
            </div>


            <div class="col-1"> 
              <br>
              <a class="btn btn-danger btn-sm mr-1" name="" href="insert_item_admin.php">Add new item</a>     
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