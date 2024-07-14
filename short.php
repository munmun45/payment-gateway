<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
    if (isset($_GET['aadhar'])) {
     $aadhar = $_GET['aadhar'];
}
        if (strlen($aadhar) !== 12 || !is_numeric($aadhar)) {
            $res = array(
                "status" => false,
                "response_code" => 22, // Use an appropriate error code
                "message" => "Please provide a valid 12-digit Aadhar number.",
            );
        } else {


$url = 'https://eportal.incometax.gov.in/iec/servicesapi/getEntity';

$headers = array(
    'Accept: application/json,',
    'Accept-Language: en,hi;q=0.9',
    'Content-Type: application/json',
    'Host: eportal.incometax.gov.in',
    'Origin: https://eportal.incometax.gov.in',
    'Referer: https://eportal.incometax.gov.in/iec/foservices/',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
);

$data = array(
    'serviceName' => 'ePanDetlService',
    'aadhaarNum' => $_GET['aadhar'],
    'uidaiDetailsFlag' => 'N',
    'viewPanStatusFlag' => 'N',
);

$payload = json_encode($data);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

echo $response = curl_exec($ch);

curl_close($ch);

  $response;

$data = json_decode($response, true);

///[{"code":"EF30021","type":"ERROR","desc":"Entered Aadhaar number is already linked with a PAN","fieldName":null}]

$msg = $data[0]['desc'];

if ($msg == "Entered Aadhaar number is already linked with a PAN") {
    $res = array(
        "status" => 200,
        "response_code" => 1, // Use an appropriate error code
        "message" => $msg,
    );
} else {
    $res = array(
        "status" => 905,
        "response_code" => 91, // Use an appropriate error code
        "message" => 'Given UID no not linked with any PAN',
    );
}
}
header('Content-Type: application/json');
echo json_encode($res);
?>