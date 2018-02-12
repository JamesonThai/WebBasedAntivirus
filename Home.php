<?php
	require_once 'Breakdown.php';
	// require_once 'authenticate.php';
	// $_SESSION['variable'] = "WHO Stole The COOKIE";
?>

<!DOCTYPE html>
<html>
<head>
	<title> AntiVirus</title>
	<link rel = "stylesheet" href = "styles.css">
</head>
<body id = "main" >
	<!-- Purpose of the first div is to explain -->
	<div id = "mainContainer"> 
		<h1> Anti-Virus File Scanner </h1>
		<h2> This web application aims to identify and isolate malware from user input files while enabling identified admins to store and view malicious files that have been identified </h2>	
	</div>
		<!-- This div contains User and admin sides -->
		<div id = "humanInteraction">
			<!-- Second div is the User input side: User can input files -->
			<div id = "usersFront">
				<h2> Please input User files here!</h1>
				<form id = "form" method="post" action="Home.php" enctype="multipart/form-data">  
				Select File to Test
					<input type="file" name="filename" size="10"> 
					<input type="submit" value= "Test File"> 
				</form>
				<p> <?php checkFile() ?> </p>
			</div>
			<!-- Third Div is for admins -->

			<div id = "adminFront">
				<!-- Here we should first require user information  -->
				<h2> Have an account? <a href = "user.php"> Login here!  </a> </h1>
			</div>
		</div>
</body>
</html>


<?php
	// Salting 
	$salt1 = "ABC123DKS!@#$/ADS";
	$salt2 = "a;kfn;ak'1@#MR!@#LTMasd";
	$password = "hello there";
	// token generation
	$token = hash("ripemd128", "$salt1$password$salt2");

	$inputUserName = $inputEmail= $inputPassword ="";

	// if(isset($_POST['user']))   $inputUserName = fix_string($_POST['user']);
	// if(isset($_POST['email']))  $inputEmail = fix_string($_POST['email']);
	// if(isset($_POST['password'])) $inputPassword =fix_string($_POST['password']);


	function checkFile(){
		if ($_FILES){
			$fileName = $_FILES['filename']['name'];
			$file_part = pathinfo($fileName);
				echo "<br> " ;
				$result = "";
				// Please note: the text file needs to be in the same directory as this php file
				$fh = fopen($fileName, "r") or die("File does not exist in the proper location or you lack permission to open it");
				$text = fix_string(fread($fh,filesize($fileName)));

				$isMalware = breakDown($text);

				if (empty($isMalware)) 				$result = "Unlikely to be Malware";
				else 								$result = "Malware Detected: " . $isMalware;
				
				fclose($fh);
				echo $result;

		} 	else 			echo ERmessages(1);	
	}

	// Fixed the String input
	function fix_string($input){
	  if (get_magic_quotes_gpc()) $input = stripslashes($input);        return htmlentities($input);
	}

	// Determines the type of messages to return back to the users
	function ERmessages($input){
		if ($input == 1)	return "Response: Please Enter a valid file!";
		else return "";
	}

// Pretty Much Section for User Verification
	// Validate the username  
	function validate_Inputusername($input){
	  if($input == "")                                                   return " no Empty inputs please! <br />";
	  else if(strlen($input) < 5)                                        return " username must be at least 5 characters long <br />";
	  else if(preg_match("/[^a-zA-Z0-9_-]/", $input))                    return " illegal chars detected in username <br />";
	                                                                     return "";
	}

	// Validate the email
	function validate_Inputemail($input){
	  if($input == "")                                                    return " email has not been found <br />";
	  else if (!((strpos($input, ".")> 0) && (strpos($input,"@")>0)) || preg_match("/[^a-zA-Z0-9.@_-]/",$input))
	                                                                      return " invalid email input <br />";
	}

	// Validate the password
	function validate_password($input){
	  if($input =="")                                                   return " Input password not found <br />";
	  else if(strlen($input) < 6)                                       return " Input password must be atleast 6 chars long <br />";
	  else if(!preg_match("/[a-z]/",$input) || !preg_match("/[A-Z]/",$input) || !preg_match("/[0-9]/",$input))
	                                                                    return " Input Password must contain capital letters, small letters and numbers <br />";
	                                                                    return "";
	}

	// Validating from the backend
	$failure = "";
	$failure = validate_Inputusername($inputUserName);
	$failure .= validate_password($inputPassword);

	if(isset($_POST['user'])){
	  if($failure == "") echo "</html><body> Form data successfully validated: $inputUserName, $inputEmail, $inputPassword. </body> </html>";
	  else               echo $failure;
	}
?>
