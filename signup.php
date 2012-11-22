<?php
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
  ?> 
  
	<form action="_Controller/createUser.php" method="post">
	    <input type="username" name="username" required placeholder="username"/>
	    <input type="password" name="password" required placeholder="password"/>
	    <input type="password_confirmation" name="password_confirmation" required placeholder="password confirmation"/>
	    <input type="text" name="location" placeholder="location"/>
	    <input type="country" name="country" placeholder="country"/>
	    <input type="submit" value="Submit" />
	</form>

</body>
</html>
