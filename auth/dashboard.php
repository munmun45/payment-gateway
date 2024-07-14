<?php
include "header.php";
$to = $userdata['user_token'];
date_default_timezone_set('Asia/Kolkata');
$startDate = date("Y-m-d");
$lastday = date("Y-m-d", strtotime("-1 day"));


///Today Collation Fetch Amount
$sql = "SELECT SUM(amount) AS total_amount FROM reports WHERE status = 'TXN_SUCCESS' AND date BETWEEN '$startDate 00:00:00' AND '$startDate 23:59:59'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalAmount = $row['total_amount'];

//Last Day Collation Fetch Amount
$sl = "SELECT SUM(amount) AS total_amount FROM reports WHERE status = 'TXN_SUCCESS' AND date BETWEEN '$lastday 00:00:00' AND '$lastday 23:59:59'";

$result = $conn->query($sl);
$row = $result->fetch_assoc();

$total_last = $row['total_amount'];


//Life Time Collation Fetch Amount
$sl_f = "SELECT SUM(amount) AS total_amount FROM reports WHERE status = 'TXN_SUCCESS' ";

$result = $conn->query($sl_f);
$row = $result->fetch_assoc();

$total_life_time = $row['total_amount'];

?>

<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Dashboard</h4>



			<!-- <div class="hk-row">
				<div class="col-lg-12 col-sm-12">
					<div class="card card-sm">
						<div class="card-body">
							<a href="https://waapi.compu-tech.shop/login" target="_blank">
								<img class="img-fluid mx-auto d-block" src="../promotion_banner/wamsg.png">
							</a>
						</div>
					</div>
				</div>
			</div> -->


			<div class="row">



				<div class="col-md-3">
					<div class="card card-stats">
						<div class="card-body ">
							<div class="row">
								<div class="col-4">
									<div class="icon-big text-center">
										<i class="la la-hourglass-end text-primary"></i>
									</div>
								</div>
								<div class="col-8 d-flex align-items-center">
									<div class="numbers">
										<p class="card-category text-primary">Today Collection </p>
										<h4 class="card-title"><b>₹<?php echo $totalAmount ?></b></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="col-md-3">
					<div class="card card-stats">
						<div class="card-body ">
							<div class="row">
								<div class="col-4">
									<div class="icon-big text-center">
										<i class="la la-hourglass-end text-primary"></i>
									</div>
								</div>
								<div class="col-8 d-flex align-items-center">
									<div class="numbers">
										<p class="card-category text-primary">Last Day Collection </p>
										<h4 class="card-title"><b>₹<?php echo $total_last ?></b></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="col-md-3">
					<div class="card card-stats">
						<div class="card-body ">
							<div class="row">
								<div class="col-4">
									<div class="icon-big text-center">
										<i class="la la-hourglass-end text-primary"></i>
									</div>
								</div>
								<div class="col-8 d-flex align-items-center">
									<div class="numbers">
										<p class="card-category text-primary">Life Time Collection </p>
										<h4 class="card-title"><b>₹<?php echo $total_life_time ?></b></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="col-md-3">
					<div class="card card-stats">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<div class="icon-big text-center">
										<i class="la la-newspaper-o text-info"></i>
									</div>
								</div>
								<div class="col-8 d-flex align-items-center">
									<div class="numbers">
										<p class="card-category text-info">Plan Expire Date</p>
										<h4 class="card-title"><?php echo htmlspecialchars($userdata['expiry'], ENT_QUOTES, 'UTF-8'); ?> :

										<?php

										$expiryDate = $userdata['expiry'];
										$today = date('Y-m-d'); // Get today's date in 'YYYY-MM-DD' format

										if (strtotime($expiryDate) >= strtotime($today)) {
											$status = "Active";
										} else {
											$status = "Expired";
										}

										?>

										<?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				
			</div>


			<div class="row row-card-no-pd">
				<div class="col-md-12">

					<div class="table-responsive">
						<table class="table table-sm table-hover table-bordered table-head-bg-primary" id="dataTable" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Customer Mobile</th>
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


									$query = "SELECT `id`, `create_date`, `gateway_txn`, `customer_mobile`, `method`, `utr`, `byteTransactionId`, `order_id`, `amount`, `status` FROM `orders` WHERE user_token = '$token' ORDER BY `create_date` DESC";
									$query_run = mysqli_query($conn, $query);


									if ($query_run) {
										
										$serialNumber = 1;
										while ($row = mysqli_fetch_assoc($query_run)) {



											echo "<tr>";
											echo "<td>" . htmlspecialchars($serialNumber, ENT_QUOTES, 'UTF-8') . "</td>";
											echo "<td>" . htmlspecialchars($row['customer_mobile'], ENT_QUOTES, 'UTF-8') . "</td>";
											echo "<td>" . htmlspecialchars($row['create_date'], ENT_QUOTES, 'UTF-8') . "</td>";
								
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
											$serialNumber++;
											echo "</tr>";
										}

									} else {
										echo "Error in query: ";
										
									}
								}

								



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

											?><td class="badge badge-dark" style="width:70px;">UPI</td><?php

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
<script src="assets/js/rechpay.js?1697738474"></script>
<script type="text/javascript">
	function utr_search(utr_number) {
		if (getCurentFileName() == "transactions") {
			if (utr_number.length == 12) {
				search_txn('2023-10-01', '2023-10-19', '', utr_number);
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
<script src="assets/js/merchant.js?1697738474"></script>