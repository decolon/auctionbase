<?php
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
  ?> 

<h1> Submit and Log in</h1>
<form action="_Controller/loginScript.php" method="post">
    <input type="text" name="username" value="decolon" />
    <input type="password" name="password" value="decolon"/>
    <input type="submit" value="Submit" />
</form>


</body>
</html>
