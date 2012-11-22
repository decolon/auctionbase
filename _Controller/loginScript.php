<?php
include_once('../_Model/dbHelper.php');
session_start();
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
		echo " The username or password is invalid";
	}
}

?>
