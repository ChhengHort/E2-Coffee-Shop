<?php

if(isset($_POST['add_to_cart'])){

   if($user_id == ''){
      header('location:login.php');
   }else{

      $pid = $_POST['pid'];
      $pid = htmlspecialchars($pid, ENT_QUOTES, 'UTF-8');
      $name = $_POST['name'];
      $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
      $price = $_POST['price'];
      // $price = filter_var($price, FILTER_SANITIZE_STRING);
      $price = filter_var($price, FILTER_VALIDATE_FLOAT);
      $image = $_POST['image'];
      // $image = filter_var($image, FILTER_SANITIZE_STRING);
      $image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
      $qty = $_POST['qty'];
      // $qty = filter_var($qty, FILTER_SANITIZE_STRING);
      $qty = filter_var($qty, FILTER_VALIDATE_INT);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if($check_cart_numbers->rowCount() > 0){
         $message[] = 'already added to cart!';
      }else{
         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
         $message[] = 'added to cart!';
         
      }

   }

}
