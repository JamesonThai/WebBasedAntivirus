<?php

$connection = mysql_connect("localhost", "root", "");
$db = mysql_select_db("antiVirus", $connection);

session_start();

$user_check = $_SESSION['login_user'];

$query = mysql_query("SELECT userName FROM approvedUsers WHERE userName = '$user_check'", $connection);
$row = mysql_fetch_assoc($query);
$login_session = $row['userName'];

if(!isset($login_session)){
	mysql_close($connection); // Closing Connection
	header('Location: user.php'); // Redirect To Home Page
}


?>