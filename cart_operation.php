<?php

  session_start();

  if(isset($_POST['check'])){
    echo check_if_added_to_cart($_POST['title']);
    exit();
  }

  if(isset($_POST['insert'])){
    echo add_to_cart($_POST['title']);
    exit();
  }

  if(isset($_POST['delete'])){
    echo remove_from_cart($_POST['title']);
    exit();
  }

  if(isset($_POST['udpate_quantity'])){
    echo update_quantity_cart($_POST['title'], $_POST['quantity']);
    exit();
  }  

  if(isset($_POST['checkout'])){
    echo check_out();
    exit();
  }

  function check_if_added_to_cart($product_title){
    require 'connection.php';
    $username=$_SESSION['username'];
    $query="SELECT * FROM Cart WHERE title='$product_title' AND username='$username'";
    $results=mysqli_query($conn,$query) or die(mysqli_error($conn));
    if(mysqli_num_rows($results)>0){
      return 1;
    }else{
      return 0;
    }    
  }

  function add_to_cart($product_title){
    require 'connection.php';
    $username=$_SESSION['username'];
    $query="SELECT * FROM Cart WHERE title='$product_title' AND username='$username'";
    $results=mysqli_query($conn,$query) or die(mysqli_error($conn));
    if(mysqli_num_rows($results)==0){
      $insert="INSERT INTO Cart (username, title, quantity) VALUES ('$username', '$product_title', 1)";
      $insert_result=mysqli_query($conn,$insert) or die(mysqli_error($conn));
      if(mysqli_num_rows($insert_result)>0){
        return 1;
      }
    }
  }

  function remove_from_cart($product_title){
    require 'connection.php';
    $username=$_SESSION['username'];
    $delete="DELETE FROM Cart WHERE title='$product_title' AND username='$username'";
    $delete_result=mysqli_query($conn,$delete) or die(mysqli_error($conn));
    if(mysqli_num_rows($delete_result)>0){
      return 1;
    }
  } 

  function update_quantity_cart($product_title, $quantity){
    require 'connection.php';
    $username=$_SESSION['username'];
    $udpate="UPDATE Cart SET quantity=$quantity WHERE title='$product_title' AND username='$username'";
    $udpate_result=mysqli_query($conn,$udpate) or die(mysqli_error($conn));
    if(mysqli_num_rows($update_result)>0){
      return 1;
    }
  } 

  function check_out(){
    //create history(copy from cart) and update the inventory
    require 'connection.php';
    $username=$_SESSION['username'];
    $sql = "SELECT * FROM Cart WHERE username='$username'";
    $results = mysqli_query($conn, $sql);
    if (mysqli_num_rows($results) > 0) {
      while($record = mysqli_fetch_array($results)){
        //create history
        $title=$record['title'];
        $quantity=$record['quantity'];
        $create_history = "INSERT INTO History (username, title, quantity) VALUES ('$username', '$title', '$quantity')";
        mysqli_query($conn,$create_history);
        
        //update product inventory
        $query_product = "SELECT * FROM Products WHERE title='$title'";
        $items = mysqli_query($conn, $query_product);
        $item = mysqli_fetch_array($items);
        $new_inventory=$item['inventory']-$quantity;
        $update_quantity="UPDATE Products SET inventory=$new_inventory WHERE title='$title'";
        mysqli_query($conn,$update_quantity) or die(mysqli_error($conn));

        //delete cart item
        $delete_cart="DELETE FROM Cart WHERE username='$username' AND title='$title'";
        mysqli_query($conn,$delete_cart) or die(mysqli_error($conn));
      }
    }
    return 1;
  }

?>


