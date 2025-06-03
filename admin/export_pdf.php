<?php
require '../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Your PDF logic here...
$options = new Options();
$options->set('defaultFont', 'Helvetica');
$dompdf = new Dompdf($options);

include '../components/connect.php';

$select_orders = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = 'completed' ORDER BY id DESC");
$select_orders->execute();

$html = '
<h2 style="text-align:center;">Completed Orders Report</h2>
<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Products</th>
            <th>Price</th>
            <th>Payment Type</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>';

if ($select_orders->rowCount() > 0) {
    while ($row = $select_orders->fetch(PDO::FETCH_ASSOC)) {
        $html .= '
        <tr>
            <td>' . $row['user_id'] . '</td>
            <td>' . $row['placed_on'] . '</td>
            <td>' . $row['name'] . '</td>
            <td>' . $row['number'] . '</td>
            <td>' . $row['address'] . '</td>
            <td>' . $row['total_products'] . '</td>
            <td>$' . $row['total_price'] . '</td>
            <td>' . $row['method'] . '</td>
            <td>Completed</td>
        </tr>';
    }
} else {
    $html .= '<tr><td colspan="9" align="center">No completed orders found.</td></tr>';
}

$html .= '
    </tbody>
</table>';

// Configure DomPDF
$options = new Options();
$options->set('defaultFont', 'Helvetica');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("completed_orders_report.pdf", ["Attachment" => 1]);
exit;
?>
