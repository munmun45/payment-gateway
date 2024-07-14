<?php
// URL of the PHP page
$url = 'https://munmunmaharana.in/payment/api/create-order';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $price = $_POST['price'];

    $product_name = $_POST['product_name'];
    $product_id = $_POST['product_id'];
    

    $data = array(
        'customer_mobile' => $number,
        'user_token' => 'c393b66a64b0aef50903f183392db230',
        'amount' => $price,
        'order_id' => rand(10000, 99999).time(),
        'redirect_url' => 'https://munmunmaharana.in/payment/success.php?name='.$name.'&number='.$number.'&email='.$email.'&product_name='.$product_name.'&product_id='.$product_id.'&price='.$price.'',
        'remark1' => 'test1',
        'remark2' => 'test2',
    );
    

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session and store the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);


    // Decode the JSON response
    $jsonResponse = json_decode($response, true);

    // Check if decoding was successful
    if ($jsonResponse !== null) {


        // Redirect the user to the payment URL
        $paymentUrl = $jsonResponse['result']['payment_url'];
        header('Location: ' . $paymentUrl);
        exit;
    } else {
        echo 'Failed to decode JSON response.';
    }
}
