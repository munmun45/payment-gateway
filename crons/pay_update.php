<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../auth/config.php";
date_default_timezone_set('Asia/Kolkata');
$cxrurl = $_SERVER["SERVER_NAME"];

// Assuming $conn is defined in the auth config

// Fetch orders with status 'PENDING' and create_date more than 30 minutes ago
$query = "SELECT * FROM orders WHERE status = 'PENDING'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching data: " . mysqli_error($conn));
}

// Iterate through all the fetched orders
while ($row = mysqli_fetch_assoc($result)) {
    // Fetch the order_id and create_date for each order
    $order_id = $row['order_id'];
    $create_date = strtotime($row['create_date']);

    // Check if create_date is more than 30 minutes ago
    $current_time = time();
    $difference_in_minutes = ($current_time - $create_date) / 60;

    if ($difference_in_minutes > 30) {
        // Update orders with status 'PENDING' and create_date more than 30 minutes ago to 'FAILED'
        $updateQuery = "UPDATE orders SET status = 'FAILED' WHERE order_id = '$order_id'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if (!$updateResult) {
            die("Error updating order: " . mysqli_error($conn));
        }

        echo "Order ID $order_id updated to FAILED.<br>";
    } else {
        echo "Order ID $order_id is not more than 30 minutes old, no update performed.<br>";
    }
}

// Close the database connection
mysqli_close($conn);
?>
