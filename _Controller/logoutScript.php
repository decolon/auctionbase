<?php 
/*
logoutScript.php
-----------------------------------------------
This file contains the code to log a user out.  
It destroys the session and then redirects to
the home page.
*/
session_start();
if(session_destroy()){
	header('Location: ../index.php');
}
?>
