<?php 
/*
newBid.php
--------------------------------------------------------------------------------
This file contains the code to create a new bid.  First it gets the data from the form.
Then it gets the time (correcting if real time is on) and gets the userID from the session.
Finally, if the prices are valid, then this will pass on to the helper everything needed to 
create the new bid

it redirects to the item page of the item just bidded on.
*/
include_once(__DIR__.'/biddingScript.php');
include_once(__DIR__.'/itemScript.php');
include_once(__DIR__.'/../_Model/biddingHelper.php');
include_once(__DIR__.'/../_Model/timeHelper.php');
session_start();
$itemID = html_entity_decode(addslashes($_POST['itemID']));
$newPrice = html_entity_decode(addslashes($_POST['bidAmount']));
$currentPrice = getCurrentPrice($itemID);
$buyPrice = getBuyPrice($itemID);
$validBid = checkPrices($newPrice, $currentPrice);
if($validBid){
	if($buyPrice != null && $newPrice > $buyPrice)$newPrice = $buyPrice;
	$userID = $_SESSION['login_user'];
	if(useRealTime()){
		$currentTime =  getTimeAsDateWithOffset(getCurrentTimeFromDB());
	}else{
		$currentTime =  getTimeAsDate(getCurrentTimeFromDB());	
	}
	insertNewBid($userID, $currentTime, $itemID, $newPrice);
}	
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../item.php?itemID='.$itemID.'">';
?>

