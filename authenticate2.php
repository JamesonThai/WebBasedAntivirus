<?php
	require_once 'login.php';

	// $connection = mysqli_connect($servername, $username, $password, $database);

	// // check connection
	// if ($connection->connect_error) die ($connection->connect_error);

	// // set database
	// mysqli_select_db($connection, $database);
	echo "got in here Authenticate.php <br>";

	// Authenticating Username and Password
	if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
		$username_temp = mysql_entities_fix_string($connection, $_SERVER['PHP_AUTH_USER']);
		$password_temp = mysql_entities_fix_string($connection, $_SERVER['PHP_AUTH_PW']);
		$query ="SELECT * FROM approvedUsers where userName = $username_temp";
		$result = $connection-> query($query);

		if (!$result) die ($connection->error);
		elseif ($result-> num_rows){
			$row = $result->fetch_array(MYSQLI_NUM);
			$result->close();
			$salt1 = "qm&h*"; $salt2= "pg!@ASda";
			$token = hash('ripemd128', "$salt1$password$salt2");

			if ($token == $row[5]){
				session_start();
				$_SESSION['username'] = $username_temp;
				$_SESSION['password]'] = $password_temp;
				$_SESSION['first_name'] = $row[1];
				$_SESSION['last_name'] = $row[2];
				$_SESSION['accessTier'] = $row[6];
				$_SESSION['lastChange'] = $row[7];

				echo "$row[0] $row[1] $row[2] Hi $row[1], you're now logged in as '$row[4]'";
				die ("<p><a href=continue.php> Click Here to Continue </a> </p>");
			}	
			else die("Invalid username/password combination");		
		}
		else{
				header('WWW-Authenticate: Basic realm="Restricted Section“');
				header('HTTP/1.0 401 Unauthorized');
				die ("Please enter your username and password");
		}
		$connection -> close();
		function mysql_entities_fix_string($connection, $string){
			return htmlentities(mysql_fix_string($connection, $string));
		}
		function mysql_fix_string($connection, $string){
			if (get_magic_quotes_gpc()) 
				$string = stripslashes($string);
			return $connection->real_escape_string($string);
		}
	}

	print_r($_SESSION);
?>