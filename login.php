<?php

include 'components/connect.php';

session_start();

// Check if user_id is stored in a cookie
if (isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $select_user->execute([$email, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        $_SESSION['user_id'] = $row['id'];

        // If "remember me" is checked, store in cookie for 30 days
        if (isset($_POST['remember'])) {
            setcookie('user_id', $row['id'], time() + (86400 * 30), "/");
        }

        header('location:index.php');
    } else {
        $message[] = 'Incorrect username or password!';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

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

<section class="form-container" style="min-height: 100vh;">
   <form action="" method="post" style="background: white; padding: 3.5rem; border-radius: 15px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center; border: 2px solid #d2c2f0;">
      <h3 style="margin-bottom: 1.5rem; font-size: 2.5rem; font-weight: 600;">Login</h3>

      <div style="position: relative; margin-bottom: 1rem;">
         <input type="email" name="email" required placeholder="Username or Email" class="box" maxlength="50"
            style="width: 100%; padding: 0.75rem 2.5rem 0.75rem 2.5rem; border: 1px solid #ccc; border-radius: 8px;" />
         <i class="fas fa-user" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #999;"></i>
      </div>

      <div style="position: relative; margin-bottom: 1rem;">
         <input type="password" name="pass" required placeholder="Enter your Password" class="box" maxlength="50"
            style="width: 100%; padding: 0.75rem 2.5rem 0.75rem 2.5rem; border: 1px solid #ccc; border-radius: 8px;" />
         <i class="fas fa-lock" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #999;"></i>
         <i class="fas fa-eye" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #999; cursor: pointer;"></i>
      </div>

      <div style="display: flex; justify-content: space-between; align-items: center; font-size: 1.2rem; margin-bottom: 1rem;">
         <label>
            <input type="checkbox" name="remember" style="margin-right: 5px;" /> Remember me
         </label>
         <a href="forgot_password.php" style="color: #2563eb; text-decoration: none;">Forgot password?</a>
      </div>

      <input type="submit" value="Login" name="submit"
         style="width: 100%; padding: 0.8rem; background: #2563eb; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;" />

    <p style="margin: 1rem 0; font-size: 14px;">Don't have an account? 
        <a href="register.php" style="color: #2563eb;">Sign up</a>
    </p>


      <div style="display: flex; align-items: center; justify-content: center; gap: 10px; margin: 1rem 0;">
         <hr style="flex-grow: 1; border: none; border-top: 1px solid #ccc;" />
         <span style="font-size: 0.9rem; color: #999;">or connect with</span>
         <hr style="flex-grow: 1; border: none; border-top: 1px solid #ccc;" />
      </div>

    <div style="display: flex; justify-content: center; gap: 2rem; align-items: center; margin-top: 1rem;">
      <a href="login_facebook.php">
         <img src="images/Facebook.png" alt="Facebook" style="height: 35px;">
      </a>
      <a href="login_google.php">
         <img src="images/google.png" alt="Google" style="height: 35px;">
      </a>
      <a href="login_github.php">
         <img src="images/Twitter.png" alt="Twitter" style="height: 35px; border-radius: 8px;">
      </a>
   </div>


   </form>
</section>


<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>
   const eyeIcon = document.querySelector('.fa-eye');
   const passwordInput = document.querySelector('input[name="pass"]');
   eyeIcon.addEventListener('click', () => {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      eyeIcon.classList.toggle('fa-eye-slash');
   });
</script>

</body>
</html>