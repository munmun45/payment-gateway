<?php
include "header.php";
date_default_timezone_set('Asia/Kolkata');
$startDate = date("Y-m-d");
$lastday = date("Y-m-d", strtotime("-1 day"));

// Today Collection Fetch Amount
$sql = "SELECT SUM(amount) AS total_amount FROM reports WHERE status = 'TXN_SUCCESS' AND date BETWEEN ? AND ?";
$stmt = $conn->prepare($sql);
$start_date_time = $startDate . " 00:00:00";
$end_date_time = $startDate . " 23:59:59";
$stmt->bind_param("ss", $start_date_time, $end_date_time);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalAmount = $row['total_amount'];

// Last Day Collection Fetch Amount
$sl = "SELECT SUM(amount) AS total_amount FROM reports WHERE status = 'TXN_SUCCESS' AND date BETWEEN ? AND ?";
$stmt = $conn->prepare($sl);
$last_start_date_time = $lastday . " 00:00:00";
$last_end_date_time = $lastday . " 23:59:59";
$stmt->bind_param("ss", $last_start_date_time, $last_end_date_time);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_last = $row['total_amount'];

// Life Time Collection Fetch Amount
$sl_f = "SELECT SUM(amount) AS total_amount FROM reports WHERE status = 'TXN_SUCCESS'";
$result = $conn->query($sl_f);
$row = $result->fetch_assoc();
$total_life_time = $row['total_amount'];
?>

<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Searching Order Id : <?php echo $_GET['search'] ?></h4>

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
									<th>Merchant Order ID</th>
									<th>Amount</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php


								$search = $_GET['search'];


								if ($userdata['role'] == 'User') {
									$token = $userdata['user_token'];
									$query = "SELECT `id`, `create_date`, `customer_mobile`, `order_id`, `amount`, `status`,`paytm_txn_ref` FROM `orders` WHERE `user_token` = ? AND `order_id` = '$search' ORDER BY `create_date` DESC";
									$stmt = $conn->prepare($query);
									$stmt->bind_param("s", $token);
									$stmt->execute();
									$result = $stmt->get_result();
									$serialNumber = 1;
									while ($row = $result->fetch_assoc()) {
										echo "<tr>";
										echo "<td>" . htmlspecialchars($serialNumber, ENT_QUOTES, 'UTF-8') . "</td>";
										echo "<td>" . htmlspecialchars($row['customer_mobile'], ENT_QUOTES, 'UTF-8') . "</td>";
										echo "<td>" . htmlspecialchars($row['create_date'], ENT_QUOTES, 'UTF-8') . "</td>";
										echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
										echo "<td>" . htmlspecialchars($row['paytm_txn_ref'], ENT_QUOTES, 'UTF-8') . "</td>";
										echo "<td>₹" . htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8') . "</td>";
										$status = htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8');
										$statusClass = ($status == "SUCCESS") ? "badge badge-primary" : (($status == "PENDING") ? "badge badge-info" : "badge badge-danger");
										echo "<td><button class='$statusClass'>$status</button></td>";
										$serialNumber++;
										echo "</tr>";
									}
								} else {
									$query = "SELECT `id`, `user_name`, `transactionId`, `date`, `order_id`, `amount`, `status` FROM `reports`";
									$result = $conn->query($query);
									while ($row = $result->fetch_assoc()) {
										echo "<tr>";
										echo "<td>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "</td>";
										echo "<td>" . htmlspecialchars($row['user_name'], ENT_QUOTES, 'UTF-8') . "</td>";
										echo "<td>" . htmlspecialchars($row['transactionId'], ENT_QUOTES, 'UTF-8') . "</td>";
										echo "<td>" . htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8') . "</td>";
										echo "<td class='badge badge-dark' style='width:70px;'>UPI</td>";
										echo "<td>" . htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') . "</td>";
										echo "<td>₹" . htmlspecialchars($row['amount'], ENT_QUOTES, 'UTF-8') . "</td>";
										$status = htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8');
										$statusClass = ($status == "SUCCESS") ? "badge badge-success" : "badge badge-warning";
										echo "<td><button class='$statusClass'>$status</button></td>";
										echo "</tr>";
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

<?php require("./footer.php") ?>

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