<?php
	// require_once('antiVirus.sql'); 
	// $conn = new mysql_connect();
	// PHP FUNCTIONS THAT ALLOW ONE TO ADD/REMOVE/EDIT
	require_once 'login.php';

	$query = "SELECT * FROM knownMalware";
	$result = $conn->query($query);
	if (!$result) die($conn->error);
	

?>
