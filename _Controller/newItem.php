<?php 
/*
newItem.php
-----------------------------------------------------------------------------------------
This file is responsible for creating a new item.  It takes all the data from the form, 
checks to make sure the time and price are valid, and then passes all the data along to 
the helper.  

TO DO Make sure to escape all the user input!!!!!!
*/
include_once(__DIR__.'/itemScript.php');
include_once('../_Model/userHelper.php');
session_start();
$itemName = html_entity_decode(addslashes($_POST['itemName']));
$buyPrice = html_entity_decode(addslashes($_POST['buyPrice']));
$firstBid = html_entity_decode(addslashes($_POST['firstBid']));
$startTime = html_entity_decode(addslashes($_POST['startTime']));
$startDate = html_entity_decode(addslashes($_POST['startDate']));
$endTime = html_entity_decode(addslashes($_POST['endTime']));
$endDate = html_entity_decode(addslashes($_POST['endDate']));
$description = html_entity_decode(addslashes($_POST['description']));
$userID = $_SESSION['login_user'];
if(checkPrices($buyPrice, $firstBid) && checkTime($startTime, $startDate, $endTime, $endDate) && sellerHasLocation($userID)){
	$itemID = addslashes(getItemID());
	addNewItem($itemName, $buyPrice, $firstBid, $startTime, $startDate, $endTime, $endDate, $description, $userID, $itemID);
	header('Location: ../item.php?itemID='.$itemID);
}else{
	header('Location: ../sellItem.php');
}






?>
