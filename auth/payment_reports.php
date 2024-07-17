<?php
include "header.php";

?>
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Payment Report</h4>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered table-head-bg-primary" id="dataTable" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Payment App Name</th>
                                    <th>Date Time</th>
                                    <th>Gateway Txn</th>
                                    <th>UTR / Ref No</th>
                                    <th>Order ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Assuming you have a valid database connection named $conn

                                if ($userdata['role'] == 'User') {
                                    $token = $userdata['user_token'];

                                    $query = "SELECT `id`, `transactionId`,  `merchantTransactionId`, `date`, `mobile`, `utr`, `user_name`, `order_id`,`paymentApp`, `amount`, `status` FROM `reports` WHERE user_token = ? ORDER BY date ASC";

                                    if ($stmt = mysqli_prepare($conn, $query)) {
                                        mysqli_stmt_bind_param($stmt, "s", $token);
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);

                                        if ($result) {
                                            $serialNumber = 1; // Initialize serial number outside the loop
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($serialNumber, ENT_QUOTES, 'UTF-8') . "</td>";
                                                echo "<td>" . htmlspecialchars($row['paymentApp'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                echo "<td>" . htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                echo "<td>" . htmlspecialchars($row['merchantTransactionId'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                echo "<td>" . htmlspecialchars($row['transactionId'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
                                                echo "<td>₹" . htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8') . "</td>";

                                                if ($row['status'] == "TXN_SUCCESS") {
                                                    $sts = 'Success';
                                                    $cls = "badge badge-primary";
                                                } else {
                                                    $sts = 'Pending';
                                                    $cls = "badge badge-dark";
                                                }
                                                echo "<td><button class='$cls'>" . $sts . "</button></td>";
                                                echo "</tr>";

                                                $serialNumber++; // Increment serial number
                                            }
                                            mysqli_free_result($result);
                                        } else {
                                            echo "Error in query: " . mysqli_error($conn);
                                        }
                                        mysqli_stmt_close($stmt);
                                    } else {
                                        echo "Error in query preparation: " . mysqli_error($conn);
                                    }
                                } else {
                                    $query = "SELECT `id`, `transactionId`, `date`, `mobile`, `UTR`, `user_name`, `order_id`, `amount`, `status` FROM `reports` ORDER BY date ASC";

                                    if ($result = mysqli_query($conn, $query)) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "</td>";
                                            echo "<td>" . htmlspecialchars($row['mobile'], ENT_QUOTES, 'UTF-8') . "</td>";
                                            echo "<td>" . htmlspecialchars($row['transactionId'], ENT_QUOTES, 'UTF-8') . "</td>";
                                            echo "<td>" . htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8') . "</td>";
                                            echo "<td class='badge badge-dark' style='width:70px;'>UPI</td>";
                                            echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
                                            echo "<td>" . htmlspecialchars($row['transactionId'], ENT_QUOTES, 'UTF-8') . "</td>";
                                            echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
                                            echo "<td>₹" . htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8') . "</td>";

                                            if ($row['status'] == "TXN_SUCCESS") {
                                                $sts = 'Success';
                                                $cls = "badge badge-success";
                                            } else {
                                                $sts = 'Pending';
                                                $cls = "badge badge-warning";
                                            }
                                            echo "<td><button class='$cls'>" . $sts . "</button></td>";
                                            echo "</tr>";
                                        }
                                        mysqli_free_result($result);
                                    } else {
                                        echo "Error in query: " . mysqli_error($conn);
                                    }
                                }

                                // Close connection
                                mysqli_close($conn);
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
<script src="assets/js/rechpay.js?1697912979"></script>
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

</html>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $("#dataTable").DataTable();
    });
</script>

<link href="https://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        $(".datepicker").datepicker({
            dateFormat: "dd-mm-yy"
        });
    });
</script>
<script src="assets/js/merchant.js?1697912979"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //$("#search").click();
    });
</script>