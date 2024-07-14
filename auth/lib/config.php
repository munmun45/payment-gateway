<?php

require_once('../database/config.php');

$upiuid = "paytmqr14b7wnpgw9@paytm";

$token = '0c13c6-7f0d44-5d9663-bdc228-215156'; 

$secret = 'IGF4lKzf2S'; 

$UPBPAY_ENVIRONMENT = 'PROD';

$UPBPAY_TXN_URL='https://upipay.compu-tech.in/order/paytm';
$UPBPAY_STATUS_URL='https://upipay.compu-tech.in/order/status';
if($UPBPAY_ENVIRONMENT == 'PROD') {
$UPBPAY_TXN_URL='https://upipay.compu-tech.in/order/paytm';	
$UPBPAY_TXN_URL='https://upipay.compu-tech.in/order/paytm';

}
?>