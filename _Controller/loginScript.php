<?php
//include_once('PasswordHash.php');

/*
loginScript.php
--------------------------------------------------------------------------
This file logs the user in if they have entered a valid username and password.
It gets to see if the username and password given in the form are valid.  If
the db returns one tuple, then it is valid and the user is logged in.  otherwise
an error message is printed out.  

TO DO: make the log in user's password hash so that they can actually log in
*/
session_start();
include_once('../_Model/dbHelper.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$userName = addslashes($_POST['username']);
	$password = addslashes($_POST['password']);
	$rowArray = dbSimpleQueryRowArray("*", "UserLogin", "UserID = \"".$userName."\" and Password = \"".$password."\"");
	$rowCount = count($rowArray);
	if($rowCount == 1)
	{
		$_SESSION['login_user'] = $userName;
		header('Location: ../userHome.php');
	}else{
		$_SESSION['error'] = " The username or password is invalid";
		header('Location: ../login.php');
	}
}

?>
