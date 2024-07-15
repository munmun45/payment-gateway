<?php
include "header.php";
?>
<div class="main-panel">
				<div class="content">
					<div class="container-fluid">

						<h4 class="page-title">Payment Link Generate</h4>	
										
						<div class="row row-card-no-pd">							
							<div class="col-md-12">

 <?php
if(isset($_POST['number'])){

	    
// Set the API endpoint URL
$api_url = 'https://munmunmaharana.in/payment/api/create-order';


$to = $userdata['user_token'];
$own_name = $userdata['company'];


// Define the payload data
$o ="QRPAY" . rand(0000,99999);


$data = array(
    'customer_mobile' => $_POST['number'],
    'user_token' => 'c6e38bc6bcea1962180df2e962e462fe',
    'amount' => '1',
    'order_id' => $o,
    'redirect_url' => 'https://munmunmaharana.in/payment',
    'remark1' => 'Online Payment Request',
    'remark2' => 'QR PAY',
);

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Encode the data as form-urlencoded
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    // Parse the JSON response
    $result = json_decode($response, true);

    // Check if the status is true or false
    if ($result && isset($result['status'])) {
        if ($result['status'] === true) {
        $link = $result['result']['payment_url'];    
        $url = "https://munmunmaharana.in/payment/link.php?url=$link";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
       
       // {"status":200,"url":"https://munmunmaharana.in/payment/link.php?pay=kdbhj9"}
        
       $url_pay = $data['url'];   
            
            
$msg = "Dear Client,🎉

We hope this message finds you well. We would like to inform you about a payment request for an amount of *₹{$_POST['amount']}*. Please find the payment link provided below:

*Payment Link:* $url_pay

*Amount:* ₹{$_POST['amount']}

This payment has been received from: *$own_name*.

If you have any questions or concerns regarding this payment request, please do not hesitate to reach out to us. Your prompt attention to this matter is highly appreciated.

 *Thank you for your cooperation.* 
Sincerely,";

                $encodedMsg = urlencode($msg);
              
              $no = $_POST['number'];  
                file_get_contents("http://waapi.compu-tech.shop/send-message?api_key=6OoYKANsraYQEZO1EpvfDt729sBXFg&sender=918391938489&number=91$no&type=text&message=$encodedMsg");
            echo "<div class='alert alert-primary' role='alert'> 
            $url_pay 
              </div>";
        } else {
            // Plan expired
            echo 'Status: ' . $result['status'] . '<br>';
            echo 'Message: ' . $result['message'];
        }
    } else {
        // Invalid response
        echo 'Invalid API response';
    }
}
    
}

// Close cURL session
curl_close($ch);
?>
								<form class="row mb-4" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="col-md-8 mb-3">
        <label>Customer Mobile Number</label>
        <input type="text" name="number" placeholder="Enter Customer Mobile Number" maxlength="10"  class="form-control" required>
    </div>
    <div class="col-md-8 mb-3">
        <label>Amount</label>
        <input type="number" name="amount" placeholder="Enter Amount"  class="form-control input-solid" required>
    </div>
    <div class="col-md-8 mb-3">
    <button type="submit" name="submit" class="btn btn-info btn-block">Submit</button>
    </div>
    
</form>
			<div class="table-responsive">
								<table class="table table-sm table-hover table-bordered table-head-bg-primary" id="dataTable" width="100%">
										<thead>
											<tr>
												<th>Mobile Number</th>
												<th>Date Time</th>
												<th>Order ID</th>
												<th>Amount</th>
												<th>Status</th>
												
											</tr>
										</thead>
										<tbody>
<?php
if($userdata['role'] == 'User'){
$token = $userdata['user_token'];


$query = "SELECT `create_date`, `gateway_txn`, `customer_mobile`, `method`, `utr`, `byteTransactionId`, `order_id`, `amount`, `status` FROM `orders` WHERE user_token = '$token' AND remark1 = 'Online Payment Request' ORDER BY `create_date` desc LIMIT 5";
$query_run = mysqli_query($conn, $query);


if ($query_run) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        
      
        
echo "<tr>";
echo "<td>" . htmlspecialchars($row['customer_mobile'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>" . htmlspecialchars($row['create_date'], ENT_QUOTES, 'UTF-8') . "</td>";

        ?>
        <?php
echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
echo "<td>₹" . htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8') . "</td>";


      // $sts = $row['status'];
        if($row['status']=="SUCCESS"){
             $sts = 'Success';
            $cls = "badge badge-primary";
        }elseif($row['status']=="PENDING"){
            $sts = 'Pending';
            $cls = "badge badge-info";
        }
        elseif($row['status']=="FAILED"){

            $sts = 'FAILED';

            $cls = "badge badge-danger";
        }
        echo "<td><button class='$cls'>" . $sts . "</button></td>";
        echo "</tr>";
    }
} else {
    echo "Error in query: ";
    //echo "Error in query: " . mysqli_error($conn); 
}
}

//admin ke lie echo 

else{
    $token = $userdata['user_token'];


$query = "SELECT `id`, `transactionId`, `date`, `mobile`, `UTR`, `user_name`, `order_id`, `amount`, `status` FROM `reports`";
$query_run = mysqli_query($conn, $query);

if ($query_run) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        
      
        
        echo "<tr>";
       echo  "<td>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "</td>";
       echo "<td>" . htmlspecialchars($row['user_name'], ENT_QUOTES, 'UTF-8') . "</td>";
       echo  "<td>" . htmlspecialchars($row['transactionId'], ENT_QUOTES, 'UTF-8') . "</td>";
       echo "<td>" . htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8') . "</td>";

        ?>
        <td class="badge badge-dark" style="width:70px;">UPI</td>
        <?php
        echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['transactionId'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>₹" . htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8') . "</td>";

        //$sts = $row['status'];
         if($row['status']=="SUCCESS"){
            $sts = 'Success';
            $cls = "badge badge-success";
        }else{
            $sts = 'Pending';
            $cls = "badge badge-warning";
        }
        echo "<td><button class='$cls'>" . $sts . "</button></td>";
        echo "</tr>";
    }
} else {
    echo "Error in query: ";
    //echo "Error in query: " . mysqli_error($conn); 
}
}
?>
											
										</tbody>
									</table>				</div>
						</div>
					</div>
				</div>
</div>
</div>
</div>
</body>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script src="assets/js/rechpay.js?1697765827"></script>
<script type="text/javascript">
function utr_search(utr_number){
if(getCurentFileName()=="transactions"){	
if(utr_number.length==12){
search_txn('2023-10-01','2023-10-20','',utr_number);
}else{
Swal.fire('Enter Valid UTR Number!');	
}
}else{
location.href ='transactions';
}
}
</script>
</html>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function () {
    $("#dataTable").DataTable();
});
</script>
<script src="assets/js/bharatpe.js?1697765827"></script>
