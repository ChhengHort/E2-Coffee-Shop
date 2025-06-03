<?php
include 'components/connect.php';

session_start();

$message = [];
// $message[] = 'Some message here';


if (isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        // For now, just a success message — you can expand this to email reset link
        $message[] = 'If this email is registered, a password reset link will be sent.';
    } else {
        $message[] = 'Email not found in our records.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Forgot Password</title>
   <link rel="stylesheet" href="css/style.css">
   <style>
      body {
         background-color: #2C2527;
         background: url('images/coffee-bg.jpg') no-repeat center center fixed;
         background-size: cover;
         margin: 0;
         padding: 0;
      }
   </style>
</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="form-container" style="min-height: 100vh;">
   <form action="" method="post" style="background: white; padding: 3.5rem; border-radius: 15px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center; border: 2px solid #d2c2f0;">
      <h3 style="margin-bottom: 1.5rem; font-size: 2.5rem; font-weight: 600;">Forgot Password</h3>

      <?php if (!empty($message) && is_array($message)) {
        foreach ($message as $msg) {
            echo '<p style="color: #d9534f; font-weight: bold;">' . $msg . '</p>';
        }
        } ?>


      <div style="position: relative; margin-bottom: 1rem;">
         <input type="email" name="email" required placeholder="Enter your email" class="box" maxlength="50"
            style="width: 100%; padding: 0.75rem 2.5rem; border: 1px solid #ccc; border-radius: 8px;" />
         <i class="fas fa-envelope" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #999;"></i>
      </div>

      <input type="submit" value="Continue" name="submit"
         style="width: 100%; padding: 0.8rem; background: #2563eb; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;" />

      <p style="margin: 1rem 0; font-size: 14px;">
         <a href="login.php" style="color: #2563eb;">Back to login</a>
      </p>
   </form>
</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>
