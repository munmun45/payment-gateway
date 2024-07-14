<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://assetsblog.bsbportal.com/wp-content/uploads/2022/01/What-is-UPI-and-how-does-it-work-.jpg" type="image/*" />
    <meta name="author" content="Compu-Tech Web Solution">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <script src="../assets/dist/js/sweetalert.min.js"></script>
    <title>UPI BASED PAYMENT GATEWAY WALLET TOP-UP</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style type="text/css">
      body{
        font-family: 'Poppins', sans-serif;
        background-color: #f6f7fb;
        display: block;
        width: 650px;
        padding: 0 13px;
      }
      a{
        text-decoration: none;
      }
      span {
        font-size: 15px;
      }
      p {
        font-size: 17px;
        line-height: 1.7;
        letter-spacing: 0.7px;
        margin-top: 0;
      }
      .text-center{
        text-align: center
      }
      @media only screen and (max-width: 767px){
        body{
            width: auto;
            margin: 20px auto;
        }
        .logo-sec{
          width: 500px !important;
        }
      }
      @media only screen and (max-width: 575px){
        .logo-sec{
          width: 400px !important;
        }
      }
      @media only screen and (max-width: 480px){
        .logo-sec{
          width: 300px !important;
        }
      }
      @media only screen and (max-width: 360px){
        .logo-sec{
          width: 250px !important;
        }
      }
    </style>
  </head>
  

<?php
date_default_timezone_set("Asia/Kolkata");
include "../pages/dbFunctions.php";
include "../pages/dbInfo.php";



$link_token = $_GET["token"];

// Fetch order_id based on the token from the payment_links table
$sql_fetch_order_id = "SELECT order_id, created_at FROM payment_links WHERE link_token = '$link_token'";
$result = getXbyY($sql_fetch_order_id);

if (count($result) === 0) {
    // Token not found or expired
    echo "Token not found or expired";
    exit;
}

$order_id = $result[0]['order_id'];
$created_at = strtotime($result[0]['created_at']);
$current_time = time();

// Check if the token has expired (more than 5 minutes)
if (($current_time - $created_at) > (50 * 60)) {
    echo "Token has expired";
    exit;
}


$slq_p = "SELECT * FROM orders where order_id='$order_id'";
$res_p = getXbyY($slq_p);    
$amount = $res_p[0]['amount'];

$hash = $res_p[0]['gateway_txn'];

$user_token = $res_p[0]['user_token'];
$redirect_url = $res_p[0]['redirect_url'];

$server_url = "$redirect_url?order_id=$order_id";


$cxrkalwaremark = $res_p[0]['byteTransactionId'];  //remark

if($redirect_url==''){
$redirect_url='https://munmunmaharana.in/payment/';    
}

 $txn_data = file_get_contents('https://munmunmaharana.in/payment/phnpe/user_txn.php?no='.$user_token.''); 
  $txn_data= substr("$txn_data",6);

    //  $json0=json_decode($txn_data,1);
    //  echo $results=$json0["data"]["results"]["0"]["transactionId"];
    
    
$obj = json_decode($txn_data);
$data=$obj->data;

$json0=json_decode($txn_data,1);
$data=$json0["data"];
$results=$data["results"];
$customerDetails=$results[$i]["customerDetails"];

    
$slq_p = "SELECT * FROM store_id where user_token='$user_token'";
        $res_p = getXbyY($slq_p);    
 $unitId = $res_p[0]['unitId'];
 
 $slq_p = "SELECT * FROM users where user_token='$user_token'";
        $res_p = getXbyY($slq_p);    
  $upi_id = $res_p[0]['upi_id'];
 $cxrmerchantTransactionId=$cxrkalwaremark;
 $asdasd23="ARC".rand(111,999).time().rand(1,100);
$orders="upi://pay?pa=$upi_id&am=$amount&pn=$unitId&tn=$asdasd23&tr=$cxrmerchantTransactionId";
$qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . urlencode($orders);

 ?>
<body style="margin: 30px auto;">
    <table style="width: 100%">
      <tbody>
        <tr>
          <td>
            <table style="background-color: #f6f7fb; width: 100%">
              <tbody>
                <tr>
                  <td>
                   
                    <table style=" margin: 0 auto; background-color: #fff; border-radius: 8px">
                      <tbody>
                        <tr>
                          <td style="padding: 30px"> 
                        <div class="col-md-6">
<div class="text-dark">
    <b><?php echo $unitId?></b><br><span>Order Id: <?php echo $order_id;?></span></div>
            </div> 
<div class="col-md-12 text-center">
<hr>
<div class="text-dark"><b>Scan QR code using BHIM or your preferred UPI app</b></div>

<div class="col-md-12 text-center mt-1">
<div class="text-center">
<img src="/assets/img/gpay.png" alt="gpay" height="20px"> 
<img src="/assets/img/paytm.png" alt="gpay" height="20px">
<img src="/assets/img/phonepe.png" alt="gpay" height="20px">
<img src="/assets/img/bhim_logo.png" alt="gpay" height="20px">
<img src="/assets/img/amazonpay.png" alt="gpay" height="20px">
</div>
</div>
<img class="mt-2 d-flex justify-content-center" src="<?php echo $qr_code_url; ?>" alt="QR Code" style="max-width: 100%;">
</div>
<div class="col-md-4 text-center">
<div class="text-dark">Total Amount <b><?php echo '₹'. $amount;?></b></div>
</div>  
<div class="text-center font-weight-bold">
    This QR code will expire in <b><span id="timeout"></span></b>
</div>

</div> 
</div>
<div class="col-md-12 text-center mt-0">
</div>
</div>
</div>
</div>
</div>

             
                        </tr>
                      </tbody>
                    </table>
                    
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
<?php 
$html = '
<form id="formSubmit" action="'.$redirect_url.'" method="post" style="display:none;">
    <input type="hidden" name="order_id" value="'.$order_id.'">
    <input type="hidden" name="hash" value="'.$hash.'">
</form>
<script>
function check() {
    $.ajax({
        type: "post",
        url: "https://munmunmaharana.in/payment/order2/payment-status",
        data: "byte_order_status='.$cxrmerchantTransactionId.'",
        success: function(data) {
            if (data == "success") {
                // Display a success message using SweetAlert
                Swal.fire({
                    title: "",
                    text: "Your Payment Received Successfully 👍 Please Wait",
                    icon: "success",
                });
                setTimeout(function(){ 
                    document.getElementById("formSubmit").submit();
                }, 2000);
            } else if (data == "FAILURE") {
                Swal.fire({
                    title: "",
                    text: "Your Payment Was Failed",
                    icon: "error",
                });
                window.location.href = "'.$server_url.'";
            }
        }
    });
}

setInterval(check, 5000);
</script>
';

echo $html;
?>

   

</body>
</html>