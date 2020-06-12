<?php
  require 'connection.php';
  session_start();


//update the product item.
  if(isset($_GET['title'])){
    $title=$_GET['title'];
    $price=$_POST["price"];
    $category=$_POST["category"];
    $inventory=$_POST["inventory"];
    $description=$_POST["description"];
    
    $sql="UPDATE Products SET price='$price', category='$category', inventory=$inventory, description='$description'";

    if($_FILES["fileupload"]["name"]){
      $path = 'img/products/';
      $img = $_FILES["fileupload"]["name"];
      $tmp = $_FILES['fileupload']['tmp_name'];

      $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
      $path = $path.strtolower($img); 
      move_uploaded_file($tmp,$path);

      $sql.=", image='$path'";
    }

    $sql.=" WHERE title='$title'";
    //echo $sql;
    //$update_result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
    if (mysqli_query($conn, $sql)){
        echo "updated successfully";
    } else {
      echo "Error: " . $sql . "" . mysqli_error($conn);
    }

    exit();
  }


  //insert new product item.
  if(isset($_POST["title"])){
    //echo "inserting...";
    $title=$_POST['title'];
    //echo "php:".$title;
    $price=$_POST["price"];
    $category=$_POST["category"];
    $inventory=$_POST["inventory"];
    $description=$_POST["description"];

    $sql="INSERT INTO Products (title, price, category, inventory, description, image) VALUES ('$title', '$price', '$category', $inventory, '$description'";


    if($_FILES["fileupload"]["name"]){
      $path = 'img/products/';
      $img = $_FILES["fileupload"]["name"];
      $tmp = $_FILES['fileupload']['tmp_name'];

      $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
      $path = $path.strtolower($img); 
      move_uploaded_file($tmp,$path);
      $sql.=", '$path')";
    }else{
      $sql.=", '')";
    }

    //echo $sql;
    if (mysqli_query($conn, $sql)){
        echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    exit();
  }

  

?>


