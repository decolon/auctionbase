<?php 
/*
createUser.php
--------------------------------------------------------------------------
This file is incharge of creating a new user and adding them to the database.

TO DO: Update so follows the convention of passing onto a helper everything that
deals with the database.

This file has three parts.  First is gets the data from the form and puts it all in variables.
Second some error checking is performed, specifically to make sure the password watches the password
confirmation.  Third it connects with the database and uploads the new user into the user table and 
the user login table. 
*/
session_start();
include_once('../_Model/userHelper.php');
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$username = addslashes($_POST['username']);
	$password = addslashes($_POST['password']);
	$password_confirmation = addslashes($_POST['password_confirmation']);
	$location = addslashes($_POST['location']);
	$country = addslashes($_POST['country']);
	if($password !== $password_confirmation){
		$_SESSION['error'] = "Password and Password confirmation do not match";
		header('Location: ../signup.php');
	}else{
		if($location == ""){
			$location = null;
		}else $location = html_entity_decode($location);
		if($country == ""){
			$country = null;
		}else $country = html_entity_decode($country);
		$password = html_entity_decode($password);
		$username = html_entity_decode($username);
		if(isUnique($username)){
			insertNewUserIntoDB($username, $password, $location, $country);	
		}else{
			header('Location: ../signup.php');	
		}
	}

}
?>
