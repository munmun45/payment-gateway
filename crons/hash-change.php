<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../auth/config.php";
date_default_timezone_set('Asia/Kolkata');

// Fetch orders with status 'PENDING' or 'SUCCESS' and paytm_txn_ref is null or blank
$query = "SELECT * FROM orders WHERE status IN ('PENDING', 'SUCCESS') AND (paytm_txn_ref IS NULL OR paytm_txn_ref = '')";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching data: " . mysqli_error($conn));
}

// Iterate through all the fetched orders
while ($row = mysqli_fetch_assoc($result)) {
    // Fetch the order_id, status, and gateway_txn for each order
    $order_id = $row['order_id'];
    $status = $row['status'];

    // Generate a new unique value for gateway_txn
    $gateway_txn = uniqid();

    // Check if the status is 'SUCCESS'
    if ($status == 'SUCCESS') {
        // Update the gateway_txn and paytm_txn_ref columns
        $updateQuery = "UPDATE orders SET gateway_txn = '$gateway_txn', paytm_txn_ref = 1 WHERE order_id = '$order_id'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if (!$updateResult) {
            die("Error updating order: " . mysqli_error($conn));
        }

        echo "Order ID $order_id updated with gateway_txn $gateway_txn and paytm_txn_ref set to 1.<br>";
    } else {
        // For 'PENDING' orders, no update is performed
        echo "Order ID $order_id has status 'PENDING', no update performed.<br>";
    }
}

// Close the database connection
mysqli_close($conn);
?>
