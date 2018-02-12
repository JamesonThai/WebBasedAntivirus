<?php
	$servername = "localhost";
	$username = "root";
	$password = ""; // sometimes ask me to verify password
	$database = "antiVirus";

	// set timezone
	date_default_timezone_set("America/Los_Angeles");

	// create connection
	$connection = mysqli_connect($servername, $username, $password, $database);

	// check connection
	if ($connection->connect_error) die ($connection->connect_error);

	// set database
	mysqli_select_db($connection, $database);
?>