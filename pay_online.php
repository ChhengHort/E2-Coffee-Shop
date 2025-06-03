<?php
include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:index.php');
}

// Get total price from URL
$total_price = isset($_GET['total_price']) ? floatval($_GET['total_price']) : 0;
?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pay Online</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Import Anton font from Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

  <!-- Cantora One -->
  <link href="https://fonts.googleapis.com/css2?family=Cantora+One&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <!-- Apply Anton font globally -->
  <style>
    body {
      font-family: 'Anton', sans-serif;
    }
  </style>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-gray-100 text-gray-800">

  <?php include 'components/user_header.php'; ?>

  <!-- Page Header -->
  <section class="bg-blue-600 text-white py-10 text-center">
    <div class="max-w-4xl mx-auto px-4">
      <h1 class="text-4xl mb-2">Payment Method</h1>
      <p class="text-lg">Complete your purchase securely using PayPal or Credit Card</p>
    </div>
  </section>

  <!-- Payment Section -->
  <section class="py-10">
    <div class="max-w-xl mx-auto px-4">
      <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="text-center mb-6">
          <i class="fas fa-credit-card text-4xl text-blue-600 mb-4"></i>
          <h2 class="text-xl">Secure Checkout</h2>
        </div>

        <!-- PayPal Script -->
        <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>

        <!-- PayPal Button Container -->
        <div id="paypal-button-container"></div>

        <script>
          paypal.Buttons({
            createOrder: (data, actions) => {
              return actions.order.create({
                purchase_units: [{
                  amount: {
                    value: '<?= number_format($total_price, 2, '.', '') ?>'
                  }
                }]
              });
            },
            onApprove: (data, actions) => {
              return actions.order.capture().then(function(orderData) {
                window.location.href = 'index.php';
              });
            }
          }).render('#paypal-button-container');
        </script>
      </div>
    </div>
  </section>

  <?php include 'components/footer.php'; ?>

  <!-- Custom JS -->
  <script src="js/script.js"></script>
</body>
</html>
