<?php
error_reporting(0);
date_default_timezone_set('Asia/Kolkata');

function connect_database() {
	$fetchType = "array";
	$dbHost    = "localhost";
	$dbLogin   = "root_db";
	$dbPwd     = "root_password";
	$dbName    = "root_username";
	$con       = mysqli_connect($dbHost, $dbLogin, $dbPwd, $dbName);
	if (!$con) {
		die("Database Connection failes" . mysqli_connect_errno());
	}
	return ($con);
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'payment_gateway');
?>