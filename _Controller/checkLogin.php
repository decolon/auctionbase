<?php 
/*
checkLogin.php
------------------------------------------------------------------------------------------
This file contains functions which help determin if the user is logged in, if they are an admin
and the correct header to put on the page.  

Functions
----------
loggedIn()
getUserID()
isAdmin()
correctHeader()
*/
include_once(__DIR__.'/../_Model/dbHelper.php');
session_start(); // need to start/continue the session every time we ask these questions

/*
loggedIn()
-------------------------------------------------------------------
This function returns true if the user is logged in, false if they are not.
First it getts the value of login_user from the session variable.  Then it
looks in the database for a user with the same username in the login table.
If there is a user, then it returns true, otherwise false
Params:
Return: true if logged in, false if not
*/
function loggedIn()
{
	$userCheck = addslashes($_SESSION['login_user']);
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
/*
getUserID()
--------------------------------------------------------------------------
This function returns the value associated with login_user in the session variable
Params:
Return: logged in user id (string)
*/
function getUserID(){
	return htmlspecialchars($_SESSION['login_user']);
}

/*
isAdmin()
-------------------------------------------------------------------
This function returns true if the user is an admin, false if they are not.
First it getts the value of login_user from the session variable.  Then it
looks in the database for a user with the same username with admin value 1 (is an admin)
in the login table. If there is a user, then they are an admin and returns true, otherwise false
Params:
Return: true if admin and logged in, false if not
*/
function isAdmin()
{
	$userCheck = addslashes($_SESSION['login_user']);
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

/*
correctHeader()
---------------------------------------------------------------------------------
This function checks to see the login status of the current user and determins
the correct header to put on the page.  It includes the header using the 
include_once php function.
Params:
Return:
*/
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
