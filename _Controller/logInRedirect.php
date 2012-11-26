<?php
/*
loginRedirect.php
---------------------------------------------------------------------
This file redirects to either the sellItem.php file or the needToLogIn.php
file depending on if the user is logged in or not.  
*/
include_once('checkLogin.php');
if(loggedIn()){
	header("Location: ../sellItem.php");
}else{
	header("Location: ../needToLogIn.php");
}
?>