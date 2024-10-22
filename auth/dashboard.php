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


// This Month Collection
$this_month_start = date("Y-m-01");
$this_month_end = date("Y-m-t");
$sql_this_month = "SELECT SUM(amount) AS total_amount FROM reports WHERE status = 'TXN_SUCCESS' AND date BETWEEN ? AND ?";
$stmt = $conn->prepare($sql_this_month);
$stmt->bind_param("ss", $this_month_start, $this_month_end);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_this_month = $row['total_amount'];

// Last Month Collection
$last_month_start = date("Y-m-01", strtotime("first day of last month"));
$last_month_end = date("Y-m-t", strtotime("last day of last month"));
$sql_last_month = "SELECT SUM(amount) AS total_amount FROM reports WHERE status = 'TXN_SUCCESS' AND date BETWEEN ? AND ?";
$stmt = $conn->prepare($sql_last_month);
$stmt->bind_param("ss", $last_month_start, $last_month_end);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_last_month = $row['total_amount'];

// This Year Collection
$this_year_start = date("Y-01-01");
$this_year_end = date("Y-12-31");
$sql_this_year = "SELECT SUM(amount) AS total_amount FROM reports WHERE status = 'TXN_SUCCESS' AND date BETWEEN ? AND ?";
$stmt = $conn->prepare($sql_this_year);
$stmt->bind_param("ss", $this_year_start, $this_year_end);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_this_year = $row['total_amount'];

// Last Year Collection
$last_year_start = date("Y-01-01", strtotime("-1 year"));
$last_year_end = date("Y-12-31", strtotime("-1 year"));
$sql_last_year = "SELECT SUM(amount) AS total_amount FROM reports WHERE status = 'TXN_SUCCESS' AND date BETWEEN ? AND ?";
$stmt = $conn->prepare($sql_last_year);
$stmt->bind_param("ss", $last_year_start, $last_year_end);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_last_year = $row['total_amount'];


//graph



// Initialize arrays for data and labels
$yearlyData = [];
$monthlyData = [];
$dailyData = [];
$labels = [];

// Get the current year
$currentYear = date("Y");

// Function to get all dates in a month
function getDatesInMonth($monthYear)
{
	$startDate = date("Y-m-01", strtotime($monthYear));
	$endDate = date("Y-m-t", strtotime($monthYear));
	$dates = [];

	$currentDate = $startDate;
	while (strtotime($currentDate) <= strtotime($endDate)) {
		$dates[] = $currentDate;
		$currentDate = date("Y-m-d", strtotime("+1 day", strtotime($currentDate)));
	}

	return $dates;
}

// Function to get yearly data
function getYearlyData($conn)
{
	$yearlyData = [];
	$sql = "SELECT YEAR(date) as year, SUM(amount) AS total_amount FROM reports WHERE status = 'TXN_SUCCESS' GROUP BY YEAR(date)";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$yearlyData[$row['year']] = $row['total_amount'];
	}
	return $yearlyData;
}

// Function to get monthly data within a year
function getMonthlyDataForYear($year, $conn)
{
	$monthlyData = [];
	for ($i = 1; $i <= 12; $i++) {
		$startDate = date("Y-m-01", strtotime("$year-$i-01"));
		$endDate = date("Y-m-t", strtotime("$year-$i-01"));

		$sql = "SELECT SUM(amount) AS total_amount FROM reports WHERE status = 'TXN_SUCCESS' AND date BETWEEN ? AND ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ss", $startDate, $endDate);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$monthlyData[] = !empty($row['total_amount']) ? $row['total_amount'] : 0;
	}
	return $monthlyData;
}

if (isset($_GET['year'])) {
	$selectedYear = $_GET['year'];
} else {
	$selectedYear = date("Y");
}


if (isset($_GET['month']) && $_GET['month'] !== 'all') {
	// Case: Both year and month are selected
	$selectedMonth = $_GET['month'];
	$startDate = date("$selectedYear-$selectedMonth-01");
	$endDate = date("$selectedYear-$selectedMonth-t");

	// Fetch daily data for the selected month and year
	$sql = "SELECT DATE(date) as day, SUM(amount) AS total_amount FROM reports WHERE status = 'TXN_SUCCESS' AND date BETWEEN ? AND ? GROUP BY DATE(date)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $startDate, $endDate);
	$stmt->execute();
	$result = $stmt->get_result();

	// Create an associative array with date as key and total amount as value
	$fetchedData = [];
	while ($row = $result->fetch_assoc()) {
		$fetchedData[$row['day']] = $row['total_amount'];
	}

	// Ensure all dates of the month are represented
	$datesInMonth = getDatesInMonth("$selectedYear-$selectedMonth");
	foreach ($datesInMonth as $date) {
		$labels[] = date("d M", strtotime($date)); // X-axis label: date with day and month
		$dailyData[] = isset($fetchedData[$date]) ? $fetchedData[$date] : 0; // 0 for missing data
	}
} else {
	// Case: Only the year is selected (show monthly data for the selected year)
	$monthlyData = getMonthlyDataForYear($selectedYear, $conn);
	for ($i = 1; $i <= 12; $i++) {
		$labels[] = date("F", strtotime("$selectedYear-$i-01")); // Label for each month
	}
}



?>

<style>
	.row-card-no-pd [class*=col-] .card:after {
		position: unset;
	}
</style>

<div class="main-panel">
	<div class="content">
		<div class="container-fluid">
			<h4 class="page-title">Dashboard</h4>
			<div class="row">
				<div class="row">
					<div class="col-md-3">
						<div class="card card-stats">
							<div class="card-body">
								<div class="row">
									<div class="col-4">
										<div class="icon-big text-center">
											<i class="la la-hourglass-end text-primary"></i>
										</div>
									</div>
									<div class="col-8 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category text-primary">Today Collection</p>
											<h4 class="card-title"><b>₹<?php echo htmlspecialchars(!empty($totalAmount) ? $totalAmount : 0, ENT_QUOTES, 'UTF-8'); ?></b></h4>
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
											<i class="la la-hourglass-end text-primary"></i>
										</div>
									</div>
									<div class="col-8 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category text-primary">Last Day Collection</p>
											<h4 class="card-title"><b>₹<?php echo htmlspecialchars(!empty($total_last) ? $total_last : 0, ENT_QUOTES, 'UTF-8'); ?></b></h4>
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
											<i class="la la-hourglass-end text-primary"></i>
										</div>
									</div>
									<div class="col-8 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category text-primary">This Month Collection</p>
											<h4 class="card-title"><b>₹<?php echo htmlspecialchars(!empty($total_this_month) ? $total_this_month : 0, ENT_QUOTES, 'UTF-8'); ?></b></h4>
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
											<i class="la la-hourglass-end text-primary"></i>
										</div>
									</div>
									<div class="col-8 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category text-primary">Last Month Collection</p>
											<h4 class="card-title"><b>₹<?php echo htmlspecialchars(!empty($total_last_month) ? $total_last_month : 0, ENT_QUOTES, 'UTF-8'); ?></b></h4>
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
											<i class="la la-hourglass-end text-primary"></i>
										</div>
									</div>
									<div class="col-8 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category text-primary">This Year Collection</p>
											<h4 class="card-title"><b>₹<?php echo htmlspecialchars(!empty($total_this_year) ? $total_this_year : 0, ENT_QUOTES, 'UTF-8'); ?></b></h4>
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
											<i class="la la-hourglass-end text-primary"></i>
										</div>
									</div>
									<div class="col-8 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category text-primary">Last Year Collection</p>
											<h4 class="card-title"><b>₹<?php echo htmlspecialchars(!empty($total_last_year) ? $total_last_year : 0, ENT_QUOTES, 'UTF-8'); ?></b></h4>
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
											<i class="la la-hourglass-end text-primary"></i>
										</div>
									</div>
									<div class="col-8 d-flex align-items-center">
										<div class="numbers">
											<p class="card-category text-primary">Lifetime Collection</p>
											<h4 class="card-title"><b>₹<?php echo htmlspecialchars(!empty($total_life_time) ? $total_life_time : 0, ENT_QUOTES, 'UTF-8'); ?></b></h4>
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
											<p class="card-category text-info">Plan Expire Date </p>
											<h4 class="card-title"><?php echo htmlspecialchars($userdata['expiry'], ENT_QUOTES, 'UTF-8'); ?> :
												<?php
												$expiryDate = $userdata['expiry'];
												$today = date('Y-m-d');
												$status = (strtotime($expiryDate) >= strtotime($today)) ? "Active" : "Expired : Please Renewal";
												?>
												<?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?>
											</h4>


										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>





				<div class="row row-card-no-pd col-12">



					<div class="col-md-12">
						<div class="card">
							<div class="card-header">


								<div class="row">

									<h4 class="col-4 card-title">Collection Chat:</h4>

									<div class="col-8">
										<form id="filterForm" method="GET" action="">
											<select name="year" id="year">
												<?php for ($i = $currentYear; $i >= $currentYear - 5; $i--): ?>
													<option value="<?php echo $i; ?>" <?php if (isset($_GET['year']) && $_GET['year'] == $i) echo 'selected'; ?>>
														<?php echo $i; ?>
													</option>
												<?php endfor; ?>
											</select>

											<select name="month" id="month">
												<option value="all">All Months</option>
												<?php for ($i = 1; $i <= 12; $i++): ?>
													<option value="<?php echo sprintf("%02d", $i); ?>" <?php if (isset($_GET['month']) && $_GET['month'] == sprintf("%02d", $i)) echo 'selected'; ?>>
														<?php echo date("F", strtotime("2024-$i-01")); ?>
													</option>
												<?php endfor; ?>
											</select>

											<button type="submit">Apply Filter</button>
										</form>
									</div>
								</div>
							</div>
							<div class="card-body">
								<canvas id="collectionChart" width="400" height="150"></canvas>
							</div>
						</div>
					</div>
				</div>












				<div class="row row-card-no-pd col-12">
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
										$query = "SELECT `id`, `create_date`, `customer_mobile`, `order_id`, `amount`, `status` FROM `orders` WHERE user_token = ? ORDER BY `create_date` DESC";
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


	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
	<script>
		var ctx = document.getElementById('collectionChart').getContext('2d');
		var collectionChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($labels); ?>,
				datasets: [{
					label: 'Collection Amount (₹)',
					data: <?php echo json_encode(isset($_GET['year']) && $_GET['year'] === 'all' ? $monthlyData : (isset($_GET['month']) && $_GET['month'] !== 'all' ? $dailyData : $monthlyData)); ?>,
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
					borderColor: 'rgba(75, 192, 192, 1)',
					borderWidth: 2,
					fill: true,
					datalabels: {
						display: true,
						align: 'top',
						anchor: 'end',
						formatter: function(value, context) {
							return value + ' ₹'; // Show amount with currency symbol
						},
						color: 'white', // Set the color of the data labels to white
					}
				}]
			},
			options: {
				scales: {
					x: {
						title: {
							display: true,
							text: '<?php echo isset($_GET['year']) && $_GET['year'] === 'all' ? "Years" : (isset($_GET['month']) && $_GET['month'] !== 'all' ? "Dates" : "Months"); ?>'
						}
					},
					y: {
						beginAtZero: true,
						title: {
							display: true,
							text: 'Collection Amount (₹)'
						}
					}
				},
				responsive: true,
				plugins: {
					legend: {
						display: true,
						position: 'top',
					},
					title: {
						display: true,
						text: '<?php echo isset($_GET['year']) && $_GET['year'] === 'all' ? "Yearly Collection Overview" : (isset($_GET['month']) && $_GET['month'] !== 'all' ? "Daily Collection Overview" : "Monthly Collection Overview"); ?>'
					},
					datalabels: {
						anchor: 'end',
						align: 'start',
					}
				}
			},
			plugins: [ChartDataLabels],
		});
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