<?php 
include_once 'authenticate.php'; 
	if(isset($_SESSION['login_user'])){
		header("location: profile.php");
	}
?>
<!DOCTYPE html>
<html>
<head>	<link rel = "stylesheet" href = "styles.css">
</head>
<body>
	<div id = userRegister> 
		<h1> Sign Up Here! </h1>
		<form id = "form" method="post" action="" enctype="multipart/form-data">
		USERNAME: 
		<input placeholder="ex: johndoe123" name="userName" type="text" require="" id ='username'> <br>
		Password: 
		<input placeholder="ex: *********" name="Password" type="password" require="" id='password'> <br> 
		<br> 
		<input type="submit" value="Sign In" name="Login">
		<span> <?php echo $errormsg?> </span>
		</form>
	</div>
</body>
</html>