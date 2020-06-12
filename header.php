<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav class="navbar navbar-dark bg-dark">
  <a href="index.php" class="navbar-brand ml-2">Hunting Store</a>
  <form class="form-inline">
    <?php
    if(isset($_SESSION['username'])){
    ?>
      <a href="history.php" class="btn btn-secondary btn-sm mr-2"><i class="fa fa-history" aria-hidden="true"></i> History</a>
      <a href="products.php" class="btn btn-primary btn-sm mr-2"><i class="fa fa-cart-plus" aria-hidden="true"></i> Shop</a>
      <a href="cart.php" class="btn btn-info btn-sm mr-2"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
      <a href="logout.php" class="btn btn-danger btn-sm mr-3"><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</a>
      <a href="#" class="btn btn-outline-light btn-sm mr-3"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $_SESSION['username'] ?></a>
    <?php
    }else{
    ?>
      <a href="signup.php" class="btn btn-success btn-sm mr-2"><i class="fa fa-user" aria-hidden="true"></i> Sign Up</a>
      <a href="login.php" class="btn btn-secondary btn-sm mr-3"><i class="fa fa-sign-in" aria-hidden="true"></i> Log In</a>
    <?php  
    }
    ?>
  </form>
</nav>