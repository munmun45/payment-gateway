<?php
function connect() {

    // API URL
    $url = 'https://hdfcmmp.mintoak.com/OneAppAuth/getKey';

    // You can generate a session id or use an existing one if needed
    $sessionid = rand();

    // Data to be sent in the POST request
    $headers = array(
        "Host: hdfcmmp.mintoak.com",
        "motoken: ", // You need to provide the actual motoken value here
        "sessionid: $sessionid",
        "accept-encoding: gzip",
        "user-agent: okhttp/4.9.1",
        "deviceid: 12545d84589c7d63",
        "content-length: 0"
    );

    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session and store the response
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        return 'Curl error: ' . curl_error($ch);
    }

    // Close the cURL session
    curl_close($ch);

    return $response;
}

echo connect();
?>
