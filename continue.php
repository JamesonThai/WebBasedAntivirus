<?php
	session_start();
if (isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	$first_name = $_SESSION['first_name'];
	$last_name = $_SESSION['last_name'];
	$accessTier = $_SESSION['accessTier'];
	$lastChange = $_SESSION['lastChange'];

	destroy_session_and_data();
	echo "Welcome back $first_name.<br>Your full name is $first_name $last_name.<br>Your username is '$username’ and your password is '$password'.<br> Your access is $accessTier and your last changes were on $lastChange";
}
else echo "Please <a href='authenticate2.php'>click HERE </a> to log in."; 

	function destroy_session_and_data(){
		$_SESSION = array();
		setcookie(session_name(), '', time() - 2592000, '/');
		session_destroy();
	}
?>