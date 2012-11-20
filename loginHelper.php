<?php 
include('./dbHelper.php');
session_start();
function loggedIn()
{
	$userCheck = $_SESSION['login_user'];
	$resultValue = dbSimpleQuerySingleValue("UserID", "UserLogin", "UserID = \"".$userCheck."\"");
	$login_user = $resultValue['UserID'];
	if(isset($login_user))
	{
		return true;
	}else
	{
		return false;
	}
}

function correctHeader(){
	if(loggedIn())
	{
		include('./privatePanel.php');
	}else
	{
		include('./publicPanel.html');
	}
}
?>
