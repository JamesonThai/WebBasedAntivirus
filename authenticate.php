<?
session_start();
// require_once 'login.php';
$errormsg = "";
if (isset($_POST['Login'])) {
	if (empty($_POST['userName']) || empty($_POST['Password'])) 		$errormsg = "Username or Password is invalid";
	else{
		// Define a Username and Password
		$temp_username = $_POST['userName'];
		$temp_password = $_POST['Password'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect("localhost", "root", "");
		// Mitigate dmg from MySQL Injection

		$temp_username = fix_string($temp_username);
		$temp_password = fix_string($temp_password);
		$temp_username = mysql_real_escape_string($temp_username);
		$temp_password = mysql_real_escape_string($temp_password);
		
		// Selecting Database
		$db = mysql_select_db("antiVirus", $connection);
		
		$query = mysql_query("SELECT * FROM approvedUsers WHERE secretPas = '$temp_password' AND userName = '$temp_username'", $connection);
		$result = mysql_num_rows($query);
		if (!$result){
			header("location: user.php");
			echo "Username or Password is invalid!";
		}
		elseif ($result == 1)	{
			echo "Successful detection";
			$_SESSION['login_user'] = $temp_username;			
			header("location: profile.php");
		}
		else 					die ("username or password is invalid");
			
		mysql_close($connection); // Close the connection
	}
}

	// Fixed the String input
	function fix_string($input){
	  if (get_magic_quotes_gpc()) $input = stripslashes($input);        return htmlentities($input);
	}
?>