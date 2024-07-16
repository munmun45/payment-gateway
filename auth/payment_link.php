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
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


                        // Set the API endpoint URL
                        $api_url = 'https://munmunmaharana.in/payment/api/create-order';


                        $to = $userdata['user_token'];
                        $own_name = $userdata['company'];




                        $data = array(
                            'customer_mobile' => $_POST['number'],
                            'user_token' => $to,
                            'amount' => $_POST['amount'],
                            'order_id' => 'LNP' . rand(1000, 9999) . time(),
                            'redirect_url' => 'https://munmunmaharana.in/payment/email/link_payment.php?number=' . $_POST['number'] . '&amount=' . $_POST['amount'] . '&email=' . $_POST['email'] . '',
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
                            <input type="text" name="number" placeholder="Enter Customer Mobile Number" maxlength="10" class="form-control" required>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label>Customer Email Id</label>
                            <input type="email" name="email" placeholder="Enter Customer Email id" class="form-control" required>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label>Amount</label>
                            <input type="number" name="amount" placeholder="Enter Amount" class="form-control input-solid" required>
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
                                if ($userdata['role'] == 'User') {
                                    $token = $userdata['user_token'];


                                    $query = "SELECT `create_date`, `gateway_txn`, `customer_mobile`, `method`, `utr`, `byteTransactionId`, `order_id`, `amount`, `status` FROM `orders` WHERE user_token = '$token' AND remark1 = 'Online Payment Request' ORDER BY `id` desc LIMIT 20";
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
                                            if ($row['status'] == "SUCCESS") {
                                                $sts = 'Success';
                                                $cls = "badge badge-primary";
                                            } elseif ($row['status'] == "PENDING") {
                                                $sts = 'Pending';
                                                $cls = "badge badge-info";
                                            } elseif ($row['status'] == "FAILED") {

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

                                else {
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
                                            if ($row['status'] == "SUCCESS") {
                                                $sts = 'Success';
                                                $cls = "badge badge-success";
                                            } else {
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
                        </table>
                    </div>
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
    function utr_search(utr_number) {
        if (getCurentFileName() == "transactions") {
            if (utr_number.length == 12) {
                search_txn('2023-10-01', '2023-10-20', '', utr_number);
            } else {
                Swal.fire('Enter Valid UTR Number!');
            }
        } else {
            location.href = 'transactions';
        }
    }
</script>

</html>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $("#dataTable").DataTable();
    });
</script>
<script src="assets/js/bharatpe.js?1697765827"></script>