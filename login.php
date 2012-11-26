<?php
/*
login.php
--------------------------------------------------------------------------
This file provides the form for logging in.  
*/
	include_once('_Controller/checkLogin.php');
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>LogIn SignUp</title>
</head>

<body>
  <?php 
  	correctHeader();
	if(isset($_SESSION['error'])){
		echo '<h1>'.htmlspecialchars($_SESSION['error']).'</h1>';
		$_SESSION['error'] = null;
	}
  ?> 

<h1> Submit and Log in</h1>
<form action="_Controller/loginScript.php" method="post">
    Username: <input type="text" name="username" value="decolon" /></br>
    Password: <input type="password" name="password" value="decolon"/></br>
    <input type="submit" value="Submit" />
</form>


</body>
</html>
