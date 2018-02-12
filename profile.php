<?php
include_once ('sessions.php');

?>
<!DOCTYPE html>
<html>
	<head>
		<title>AntiVirus</title>
		<link href="styles.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="profilePage">
			<h1 id="welcome">Welcome : <?php echo $login_session; ?> </h1>
		</div>
		<!-- Display current information about the database -->
		<div id="submitMalware">
			<h2> Got a malware to submit? Put it here?</h2>
			<!-- Form information -->
			<form id = "form" method="post" action="profile.php" enctype="multipart/form-data">  
				Select File to Test
					<input type="file" name="filename" size="10"> 
					Name of Malware
					<input placeholder="MalwareName" name="mal" type="text" require="" id ='MalwareName'>
					<input type="submit" value= "submit"> 
			</form>
			<?php checkFileInput()?>
			<h2 id="logout"><a href="logout.php">Log Out</a></h2>
		</div>
		<div id="listOfMalware">
		</div>
	</body>
</html>
<?php
	function checkFileInput(){
			if (isset($_FILES['filename']['name']) && isset( $_POST['mal'] )){
			$fileName = $_FILES['filename']['name'];
			$file_part = pathinfo($fileName);
			$name = $_POST['mal'];
			echo "<br> " ;
			// Please note: the  file needs to be in the same directory as this php file
			$fh = fopen($fileName, "r") or die("File does not exist in the proper location or you lack permission to open it");
			$text = fix_string(fread($fh,20));
			startUpload($text, $name);
			fclose($fh);

			echo "Upload Successful";
		} 	
		else 			echo "Response: Please Enter a valid file and Name!";	

	}

/*
Reads the file in input per bytes and, if is a surely infected one, store the sequence of bytes, say, the first 20 bytes (signature) of the file, in a database
*/
	function startUpload($input, $name){
		$result = "";
		if (preg_match("/[^a-zA-Z0-9]/", $$name)){
			require_once 'login.php';
			$subquery = "INSERT INTO knownMalware VALUES (NULL, '$name', '$input', CURRENT_TIMESTAMP)";
			$subresult = $connection -> query($subquery);
			if (!$subresult) die ($connection->error);
		}
		else{
			echo "errr you got something wrong here that's not an english letter or number!";
		}
	}

	function mysql_entities_fix_string($connection, $string){
			return htmlentities(mysql_fix_string($connection, $string));
	}
	function mysql_fix_string($connection, $string){
		if (get_magic_quotes_gpc()) 
			$string = stripslashes($string);
		return $connection->real_escape_string($string);
	}

	// Fixed the String input
	function fix_string($input){
	  if (get_magic_quotes_gpc()) $input = stripslashes($input);        return htmlentities($input);
	}

?>