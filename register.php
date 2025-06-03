<?php
// Add this to the top with your other includes
require 'vendor/autoload.php'; // Adjust path if needed
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendOTP($email, $otp) {
   $mail = new PHPMailer(true);
   try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'ahhortloplop@gmail.com'; // replace with yours
      $mail->Password = 'bplevokizfhmsaze';        // replace with app password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port = 465;

      $mail->setFrom('ahhortloplop@gmail.com', 'E2 Coffee Shop');
      $mail->addAddress($email);
      $mail->isHTML(true);
      $mail->Subject = 'Email Verification OTP';
      $mail->Body = "<p>Your OTP code is: <strong>$otp</strong></p>";

      $mail->send();
      return true;
   } catch (Exception $e) {
      error_log($mail->ErrorInfo);
      return false;
   }
}


include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = trim($_POST['name']);
   $name = htmlspecialchars(strip_tags($name), ENT_QUOTES, 'UTF-8');
   $email = trim($_POST['email']);
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
   $number = trim($_POST['number']);
   $number = preg_replace("/[^0-9]/", "", $number);
   $pass = trim($_POST['pass']);
   $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
   $cpass = trim($_POST['cpass']);
   $cpass = htmlspecialchars(strip_tags($cpass), ENT_QUOTES, 'UTF-8');

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
   $select_user->execute([$email, $number]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email or number already exists!';
   }else{

        if ($pass != $cpass) {
        $message[] = 'confirm password not matched!';
        } else {
        $otp = rand(100000, 999999);

        $_SESSION['register_otp'] = $otp;
        $_SESSION['register_data'] = [
            'name' => $name,
            'email' => $email,
            'number' => $number,
            'password' => $hashed_pass
        ];

        if (sendOTP($email, $otp)) {
            header('Location: verify_otp.php');
            exit();
        } else {
            $message[] = 'Failed to send OTP. Please try again.';
        }
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
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
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
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="form-container">

   <form action="" method="post">
      <h3>Register Account</h3>
      <input type="text" name="name" required placeholder="enter your name" class="box" maxlength="50">
      <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" name="number" required placeholder="enter your phone number" class="box" min="0" max="9999999999" maxlength="10">
      <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="confirm your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" name="submit" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</section>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>