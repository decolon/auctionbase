<?php 
include_once(__DIR__.'/../_Model/dbHelper.php');
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

function isAdmin()
{
	$userCheck = $_SESSION['login_user'];
	$resultValue = dbSimpleQuerySingleValue("*", "UserLogin", "UserID = \"" .$userCheck. "\" and Admin = 1");
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
		if(isAdmin())
		{
			include_once(__DIR__.'/../adminNav.html');
		}else
		{
			include_once(__DIR__.'/../privateNav.html');
		}
	}else
	{
		include_once(__DIR__.'/../publicNav.html');
	}
}
?>
