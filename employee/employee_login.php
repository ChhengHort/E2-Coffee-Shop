<?php

include '../components/connect.php';

session_start();

if (isset($_POST['submit'])) {

   $email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '';
   $raw_pass = $_POST['pass'];

   $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE email = ?");
   $select_employee->execute([$email]);

   if ($select_employee->rowCount() > 0) {
      $fetch_employee = $select_employee->fetch(PDO::FETCH_ASSOC);

      if (password_verify($raw_pass, $fetch_employee['password'])) {
         $_SESSION['employee_id'] = $fetch_employee['id'];
         header('location:employee_dashboard.php');
         exit;
      } else {
         $message[] = 'incorrect username or password!';
      }
   } else {
      $message[] = 'incorrect username or password!';
   }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Employee login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/custom_login.css">

   <style>
      body{
         background: url(../images/coffee-bg.jpg) no-repeat center center/cover;
         height: 100vh;
         background-size: cover;
         background-position: center;
      }
   </style>
</head>

<body>

   <?php
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

   <section class="box">

      <form action="" method="POST">
         <h1>Employee</h1>
         <ul>
            <li><label for="name">User name</label></li>
            <li><input type="text" name="name" maxlength="20" required placeholder=""></li>
            <li><label for="name">Password</label></li>
            <li><input type="password" name="pass" maxlength="20" required placeholder=""></li>
         </ul>
         <label for="name"></label>
         <input type="submit" value="login" name="submit" class="button">
      </form>

   </section>

   <!-- employee login form section ends -->
</body>

</html>