<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:index.php');
   exit;
}

// Handle delete booking
if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_booking = $conn->prepare("DELETE FROM `bookings` WHERE id = ?");
   $delete_booking->execute([$delete_id]);
   header('location:view_bookings.php');
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>View Bookings</title>

   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="../css/dashboard_style.css">
   <link rel="stylesheet" href="../css/table.css">

</head>

<body>

   <?php include '../components/admin_header.php'; ?>

   <section class="placed-orders">

      <h1 class="heading">Table Bookings</h1>

      <div class="table_header">
         <p>Booking List</p>
         <div>
            <input placeholder="search...">
            <button class="add_new">search</button>
         </div>
      </div>

      <div>
         <table class="table">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>People</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $select_bookings = $conn->prepare("SELECT * FROM `bookings` ORDER BY date DESC, time DESC");
               $select_bookings->execute();
               if ($select_bookings->rowCount() > 0) {
                  while ($booking = $select_bookings->fetch(PDO::FETCH_ASSOC)) {
               ?>
                     <tr>
                        <td><?= $booking['id']; ?></td>
                        <td><?= htmlspecialchars($booking['person']); ?></td>
                        <td><?= $booking['date']; ?></td>
                        <td><?= $booking['time']; ?></td>
                        <td>
                           <a style="width: 150px; margin: auto;" href="view_bookings.php?delete=<?= $booking['id']; ?>" class="delete-btn" onclick="return confirm('Delete this booking?');">Delete</a>
                        </td>
                     </tr>
               <?php
                  }
               } else {
                  echo '<tr><td colspan="5" class="empty">No bookings found.</td></tr>';
               }
               ?>
            </tbody>
         </table>
      </div>

   </section>

   <script src="../js/admin_script.js"></script>

</body>

</html>
