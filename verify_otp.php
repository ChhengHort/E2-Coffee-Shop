<?php
include 'components/connect.php';
session_start();

if (!isset($_SESSION['register_data']) || !isset($_SESSION['register_otp'])) {
   header('Location: register.php');
   exit();
}

if (isset($_POST['verify'])) {
   $entered_otp = trim($_POST['otp']);
   $correct_otp = $_SESSION['register_otp'];

   if ($entered_otp == $correct_otp) {
      $data = $_SESSION['register_data'];

      // Insert into database
      $stmt = $conn->prepare("INSERT INTO `users` (name, email, number, password) VALUES (?, ?, ?, ?)");
      $stmt->execute([$data['name'], $data['email'], $data['number'], $data['password']]);

      // Clear session data
      unset($_SESSION['register_data']);
      unset($_SESSION['register_otp']);

      // Log the user in
      $user_id = $conn->lastInsertId();
      $_SESSION['user_id'] = $user_id;

      header('Location: index.php');
      exit();
   } else {
      $error = "Invalid OTP. Please try again.";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Verify OTP</title>
   <link rel="stylesheet" href="css/style.css">

   <style>
      body{
         background-color: #2C2527;
         margin: 0;
         padding: 0;
         background: url('images/coffee-bg.jpg') no-repeat center center fixed;
         background-size: cover;
      }
   </style>
</head>
<body>

<section class="form-container">
   <form method="post">
      <h3>Verify Email OTP</h3>
      <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
      <input type="number" name="otp" placeholder="Enter OTP" required class="box" maxlength="6">
      <input type="submit" name="verify" value="Verify" class="btn">
   </form>
</section>

</body>
</html>
