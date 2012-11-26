<?php
/*
signup.php
--------------------------------------------------------------------
This file contains the form necesary to sign up for the sight.
*/
	include_once('_Controller/checkLogin.php');
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Sign In</title>
</head>

<body>
  <?php 
  	correctHeader();
	if(isset($_SESSION['error'])){
		echo '<h1>'.htmlspecialchars($_SESSION['error']).'</h1>';	
		$_SESSION['error'] = null;
	}
	
  ?> 
  
	<form action="_Controller/createUser.php" method="post">
	    Username: <input type="username" name="username" required placeholder="username"/></br>
	    Password: <input type="password" name="password" required placeholder="password"/></br>
	    Password Confirmation: <input type="password" name="password_confirmation" required placeholder="password confirmation" size="25"/></br>
	    Location: <input type="text" name="location" placeholder="location"/></br>
	    Country: <input type="country" name="country" placeholder="country"/></br>
	    <input type="submit" value="Submit" />
	</form>

</body>
</html>
