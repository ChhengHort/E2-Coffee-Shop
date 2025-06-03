<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:index.php');
   exit;
}

if (isset($_POST['submit'])) {

   $name = trim(strip_tags($_POST['name']));
   $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
   $sex = isset($_POST['sex']) ? trim(strip_tags($_POST['sex'])) : '';
   $phone = isset($_POST['phone']) ? preg_replace('/[^0-9+]/', '', $_POST['phone']) : '';
   $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
   $address = isset($_POST['address']) ? trim(strip_tags($_POST['address'])) : '';
   $raw_pass = isset($_POST['pass']) ? $_POST['pass'] : '';
   $cpass = isset($_POST['cpass']) ? $_POST['cpass'] : '';

   $select_employee = $conn->prepare("SELECT * FROM `employee` WHERE name = ? OR email = ?");
   $select_employee->execute([$name, $email]);

   // if ($select_employee->rowCount() > 0) {
   //    $message[] = 'Username or email already exists!';
   // } else {
   //    if ($raw_pass !== $cpass) {
   //       $message[] = 'Confirm password does not match!';
   //    } else {
   //       $raw_pass = $_POST['pass'];
   //       $insert_employee = $conn->prepare("INSERT INTO `employee`(name, age, sex, phone, email, address, password) VALUES(?,?,?,?,?,?,?)");
   //       $insert_employee->execute([$name, $age, $sex, $phone, $email, $address, $pass]);
   //       $message[] = 'New employee registered!';
   //    }
   // }
   if ($select_employee->rowCount() > 0) {
   $message[] = 'Username or email already exists!';
   } else {
      if ($raw_pass !== $cpass) {
         $message[] = 'Confirm password does not match!';
      } else {
         $pass = password_hash($raw_pass, PASSWORD_DEFAULT);

         // ✅ ដំណើរការបញ្ចូលបានលើកនេះ
         $insert_employee = $conn->prepare("INSERT INTO `employee`(name, age, sex, phone, email, address, password) VALUES(?,?,?,?,?,?,?)");
         $insert_employee->execute([$name, $age, $sex, $phone, $email, $address, $pass]);
         $message[] = 'New employee registered!';
      }
   }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Employee</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/dashboard_style.css">
</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="form-container">
   <form action="" method="POST">
      <h3>Register New Employee</h3>
      <input type="text" name="name" maxlength="50" required placeholder="Enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" name="age" min="16" max="100" required placeholder="Enter your age" class="box">
      <select name="sex" required class="box">
         <option value="" disabled selected>Select sex</option>
         <option value="Male">Male</option>
         <option value="Female">Female</option>
         <option value="Other">Other</option>
      </select>
      <input type="text" name="phone" maxlength="15" required placeholder="Enter your phone number" class="box">
      <input type="email" name="email" maxlength="100" required placeholder="Enter your email" class="box">
      <input type="text" name="address" maxlength="255" required placeholder="Enter your address" class="box">
      <input type="password" name="pass" maxlength="50" required placeholder="Enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" maxlength="50" required placeholder="Confirm your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Register Now" name="submit" class="btn">
   </form>
</section>

<script src="../js/admin_script.js"></script>
</body>
</html>
