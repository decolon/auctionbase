<?php 
/*
currtime.php
-------------------------------------------------------------------------------
This file displays the current time from the database
Note: this is not the current time in real life, it is the current time in the
auctionbase universe.  It is the time that an admin can set in selecttime.php.
*/
include_once('_Controller/checkLogin.php');
include_once('_Controller/timeScript.php');
?>

<html>
<head>
<title>AuctionBase</title>
</head>

<?php 
 correctHeader();
?> 

<center>
<h3> Current Time </h3> 

<?php
	if(useRealTime()){
		$currentTime =  getTimeAsDateWithOffset(getCurrentTimeFromDB());
		echo $currentTime->format('Y:m:d H:i:s');
	}else{
		$currentTime =  getTimeAsDate(getCurrentTimeFromDB());	
		echo $currentTime->format('Y:m:d H:i:s');

	}
?>
</center>
</html>

