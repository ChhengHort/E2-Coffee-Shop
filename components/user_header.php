<?php
include_once 'components/connect.php'; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'] ?? null;

if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <div class="logo">
         <a href="index.php" >
            <!-- <img src="images/logo.png" alt="Cafe Shop"> -->
            <img src="images/logo.png" alt="Cafe Shop">
         </a>
         <a href="index.php">
            <h1><span>E2</span> Coffee Shop</h1>
            <!-- <img style="width:80px; height: 70px;" src="images/text-e2.png" alt="Cafe Shop"> -->
         </a>
      </div>
      
      <nav class="navbar">
         <a href="index.php">HOME</a>
         <a href="about.php">ABOUT</a>
         <a href="product.php">PRODUCT</a>
         <a href="menu.php">MENU</a>
         <a href="orders.php">ORDER</a>
         <a href="contact.php">CONTACT</a>
      </nav>

      <div class="icons">
         <?php
         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
            <p class="name"><?= $fetch_profile['name']; ?></p>
            <div class="flex">
               <a style="margin-left: 10px;" href="profile.php" class="btn">profile</a>
               <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
            </div>
            <!-- <p class="account">
               <a href="login.php">login</a> or
               <a href="register.php">register</a>
            </p> -->
         <?php
         } else {
         ?>
            <p class="name">please login first!</p>
            <a href="login.php" class="btn">login</a>
         <?php
         }
         ?>
      </div>

   </section>

</header>