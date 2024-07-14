<?php
// URL of the PHP page
$url = 'https://qr.webupipay.online/api/create-order';

// Data to be sent in the POST request
$data = array(
    'customer_mobile' => '1234567890',
    'user_token' => '1ae0b12c53a3223c9ab631f71744bcea',
    'amount' => '1',
    'order_id' => '123456'.time(),
    'redirect_url' => 'https://qr.webupipay.online/success',
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
?>
