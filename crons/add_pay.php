<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../auth/config.php";

$cxrurl = $_SERVER["SERVER_NAME"];

// Assuming $conn is defined in the auth config

// Fetch orders with status 'SUCCESS'
$query = "SELECT * FROM orders WHERE status = 'SUCCESS'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching data: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($result)) {
    // Fetch data from the 'orders' table
    $order_id = $row['order_id'];
    $utr = $row['utr'];
    $user_token = $row['user_token'];
    $amount = $row['amount'];
    // ... add other columns as needed

    // Check if the order_id already exists in the 'reports' table
    $checkQuery = "SELECT * FROM reports WHERE order_id = '$order_id'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (!$checkResult) {
        die("Error checking data in reports table: " . mysqli_error($conn));
    }

    // If the order_id doesn't exist, insert data into the 'reports' table
    if (mysqli_num_rows($checkResult) == 0) {
        $insertQuery = "INSERT INTO reports (transactionId, status, order_id, amount, user_token, date, mobile, user_name) 
                        VALUES ('$utr', 'SUCCESS', '$order_id', '$amount', '$user_token', NOW(), '{$row['customer_mobile']}', '{$row['customer_name']}')";

        $insertResult = mysqli_query($conn, $insertQuery);

        if (!$insertResult) {
            die("Error inserting data into reports table: " . mysqli_error($conn));
        }
    } else {
        echo "Order ID $order_id already exists in reports table.<br>";
    }

    mysqli_free_result($checkResult);
}

// Close the database connection
mysqli_close($conn);
?>
