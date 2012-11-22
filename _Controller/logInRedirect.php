<?php
include_once('checkLogin.php');
if(loggedIn()){
	header("Location: ../sellItem.php");
}else{
	header("Location: ../needToLogIn.php");
}
?>