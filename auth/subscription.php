<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Generate CSRF token if not present
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

include "header.php"; ?>

<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Subscription & Plans</h4>

            <div class="alert alert-info">
                <span data-notify="icon" class="la la-bell"></span>
                <button type="button" class="close" data-dismiss="alert">x</button>
                <b>Note:</b> Your old plan will be automatically deactivated after purchasing the new plan and is non-refundable.
            </div>

            <p class="card-title">
                <?php
                $expiryDate = $userdata['expiry'];
                $today = date('Y-m-d');

                $status = (strtotime($expiryDate) >= strtotime($today)) ? "The expiry date of your plan is ".$expiryDate."" : "Your plan is already Expiry Please Renew it";
                echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8');
                ?>
            </p>

            <div class="row">
                <!-- Plan Cards -->
                <?php
                $plans = [
                    ['name' => 'Trail', 'price' => 129, 'duration' => '28'],
                    ['name' => 'Starter', 'price' => 359, 'duration' => '84'],
                    ['name' => 'Business', 'price' => 559, 'duration' => '182'],
                    ['name' => 'Enterprise', 'price' => 999, 'duration' => '365'],
                ];

                foreach ($plans as $plan) {
                ?>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $plan['name']; ?></h4>
                                <h2 class="text-center">₹<?php echo $plan['price']; ?></h2>
                                <p class="card-category"><?php echo $plan['duration']; ?> Days</p>
                            </div>

                            <div class="card-footer">
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input type="hidden" name="mobile" value="<?php echo $userdata['mobile']; ?>">
                                    <input type="hidden" name="email" value="<?php echo $userdata['email']; ?>">
                                    <input type="hidden" name="user_token" value="<?php echo $userdata['user_token']; ?>">
                                    <input type="hidden" name="amount" value="<?php echo $plan['price']; ?>">
                                    <input type="hidden" name="duration" value="<?php echo $plan['duration']; ?>">
                                    <button name="upigate" class="btn btn-success btn-block">Buy Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>



            <?php

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {





                // Set the API endpoint URL
                $api_url = 'https://munmunmaharana.in/payment/api/create-order';

                // Define the payload data
                $data = array(
                    'customer_mobile' => $_POST["mobile"],
                    'user_token' => 'c6e38bc6bcea1962180df2e962e462fe',
                    'amount' => $_POST["amount"],
                    'order_id' => 'REN' . rand(1000, 9999) . time(),
                    'redirect_url' => 'https://munmunmaharana.in/payment/auth/email/e-mail.php?token=' . $_POST["user_token"] . '&days='.$_POST["duration"].'&email='.$_POST["email"].'&amount='.$_POST["amount"].'',
                    'remark1' => 'Renewal date : '. date("Y-m-d"),
                    'remark2' => 'Renewal Duration'.$_POST["duration"],
                );

                // Initialize cURL session
                $ch = curl_init();

                // Set cURL options
                curl_setopt($ch, CURLOPT_URL, $api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Encode the data as form-urlencoded

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
                            // Order was created successfully
                            // echo 'Order Created Successfully<br>';
                            echo 'Order ID: ' . $result['result']['orderId'] . '<br>';
                            echo 'Payment URL: ' . $result['result']['payment_url'];

                            $payment_url = $result['result']['payment_url'];

                            echo "
                                <script>window.location.href = '$payment_url';</script>

                            ";

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

                // Close cURL session
                curl_close($ch);
            }

            ?>





        </div>
    </div>
</div>

<!-- Include scripts -->
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script src="assets/js/rechpay.js?1697835127"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $("#dataTable").DataTable();
    });
</script>
<script src="assets/js/bharatpe.js?1697835127"></script>
<script type="text/javascript">
    function utr_search(utr_number) {
        if (getCurentFileName() == "transactions") {
            if (utr_number.length == 12) {
                search_txn('2023-10-01', '2023-10-21', '', utr_number);
            } else {
                Swal.fire('Enter Valid UTR Number!');
            }
        } else {
            location.href = 'transactions';
        }
    }
</script>

</body>

</html>