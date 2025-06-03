<?php
include '../components/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
   header('location:index.php');
   exit;
}

$date_filter = '';
if (isset($_POST['search_date']) && !empty($_POST['search_date'])) {
   $date_filter = $_POST['search_date'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sales Report</title>
   <script src="https://cdn.tailwindcss.com"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/dashboard_style.css">
   <link rel="stylesheet" href="../css/table.css">
</head>
<body class="bg-gray-100 text-gray-800 text-lg"> <!-- Increased base text size -->

   <?php include '../components/admin_header.php'; ?>

   <section class="p-10 pt-24 min-h-screen">
      <div class="max-w-screen-2xl w-full mx-auto bg-white shadow-lg rounded-2xl p-10">
         <h1 class="text-5xl font-bold mb-8">Report Sales</h1> <!-- Larger heading -->

         <!-- Date Filter Form -->
         <form method="POST" class="flex items-center gap-4 mb-8">
            <input type="date" name="search_date" value="<?= htmlspecialchars($date_filter) ?>" class="border border-gray-300 rounded px-6 py-3 text-lg">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 text-lg">
               <i class="fa fa-search mr-2"></i>Search by Date
            </button>
         </form>

         <div class="overflow-x-auto">
            <div class="flex justify-end mb-6">
                <a href="export_pdf.php" class="bg-red-600 text-white px-6 py-3 rounded hover:bg-red-700 inline-block text-lg">
                    <i class="fa fa-file-pdf"></i> Export to PDF
                </a>
            </div>

            <table class="min-w-full bg-white text-lg text-left border border-gray-200">
               <thead class="bg-gray-200 text-xl font-semibold text-center">
                    <tr>
                        <th class="px-4 py-3 border">No</th>
                        <th class="px-4 py-3 border">Date</th>
                        <th class="px-4 py-3 border">Name</th>
                        <th class="px-4 py-3 border">Phone</th>
                        <th class="px-4 py-3 border">Address</th>
                        <th class="px-4 py-3 border">Products</th>
                        <th class="px-4 py-3 border">Price</th>
                        <th class="px-4 py-3 border">Payment Type</th>
                        <th class="px-4 py-3 border">Status</th>
                    </tr>
                </thead>

               <tbody>
                    <?php
                    $count = 1;

                    if ($date_filter) {
                        $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = 'completed' AND DATE(placed_on) = ? ORDER BY id DESC");
                        $select_orders->execute([$date_filter]);
                    } else {
                        $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = 'completed' ORDER BY id DESC");
                        $select_orders->execute();
                    }

                    if ($select_orders->rowCount() > 0) {
                        while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr class="border-t text-center">
                        <td class="px-4 py-3 border"><?= $count++; ?></td>
                        <td class="px-4 py-3 border"><?= $fetch_orders['placed_on']; ?></td>
                        <td class="px-4 py-3 border"><?= $fetch_orders['name']; ?></td>
                        <td class="px-4 py-3 border"><?= $fetch_orders['number']; ?></td>
                        <td class="px-4 py-3 border"><?= $fetch_orders['address']; ?></td>
                        <td class="px-4 py-3 border"><?= $fetch_orders['total_products']; ?></td>
                        <td class="px-4 py-3 border">$<?= $fetch_orders['total_price']; ?></td>
                        <td class="px-4 py-3 border"><?= $fetch_orders['method']; ?></td>
                        <td class="px-4 py-3 border text-green-600 font-semibold">Completed</td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="9" class="text-center py-6 text-gray-500 text-lg">No completed orders found for this date.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
         </div>
      </div>
   </section>

   <script src="../js/admin_script.js"></script>
</body>
</html>
