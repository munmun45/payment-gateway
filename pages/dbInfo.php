<?php
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');

function connect_database() {
	$fetchType = "array";
	$dbHost    = "localhost";
	$dbLogin   = "u759718842_qrpay";
	$dbPwd     = "Webqrpay1@";
	$dbName    = "u759718842_qrpay";
	$con       = mysqli_connect($dbHost, $dbLogin, $dbPwd, $dbName);
	if (!$con) {
		die("Database Connection failes" . mysqli_connect_errno());
	}
	return ($con);
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'u759718842_qrpay');
define('DB_PASSWORD', 'Webqrpay1@');
define('DB_NAME', 'u759718842_qrpay');
?>