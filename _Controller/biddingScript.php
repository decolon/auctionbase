<?php 
/*
biddingScript.php
-----------------------------------------------------------------------------
This file contains functions that aid in the bidding process.  The functions primarily
deal with price and time. 

Functions
-----------
getCurrentPrice($itemID)
getBuyPrice($itemID)
getTimeLeft($itemID)
getTimeToStart($itemID)
auctionOpen($itemID)
*/

include_once(__DIR__.'/timeScript.php');
include_once(__DIR__.'/../_Model/biddingHelper.php');

/*
getCurrentPrice($itemID)
------------------------------------------------------
This function takes an ItemID and returns a real from the
database which represents the current price of an item
Params: itemID (integer)
Return: CurrentPrice (real)
*/
function getCurrentPrice($itemID){
	$currentPrice = htmlspecialchars(currentPriceFromDB(addslashes($itemID)));
	return $currentPrice;
}

/*
getBuyPrice($itemID)
------------------------------------------------------
This function takes an ItemID and returns a real from the
database which represents the buy price of an item.  If there
is no buy price, then null is returned. 
Params: itemID (integer)
Return: buyPrice (real) or null
*/
function getBuyPrice($itemID){
	$buyPrice = htmlspecialchars(buyPriceFromDB(addslashes($itemID)));
	return $buyPrice;
}

/*
getTimeLeft($itemID)
------------------------------------------------------
This function takes an ItemID and returns a string from the
database which represents the time left before the auction's end
(EndTime - CurrentTime) If real time is actvated, the current time from the 
database will be augmented by the amount of time since real time was 
last activated.
Params: itemID (integer)
Return: time before auction end (string)
*/
function getTimeLeft($itemID){
	$itemID = addslashes($itemID);
	if(useRealTime()){
		$currentTime =  getTimeAsDateWithOffset(getCurrentTimeFromDB());
	}else{
		$currentTime =  getTimeAsDate(getCurrentTimeFromDB());	
	}	
	$endTimeAsDate = getTimeAsDate(getEndTimeFromDB($itemID));
	$interval = $currentTime->diff($endTimeAsDate);
	return htmlspecialchars($interval->format('%R %a days %h hours %i minutes %s seconds'));
}

/*
getTimeToStart($itemID)
------------------------------------------------------
This function takes an ItemID and returns a string from the
database which represents the time until the auction begins.
(CurrentTime - StartTime) If real time is actvated, the current time from the 
database will be augmented by the amount of time since real time was 
last activated.
Params: itemID (integer)
Return: time until the auction starts (string)
*/
function getTimeToStart($itemID){
	$itemID = addslashes($itemID);
	if(useRealTime()){
		$currentTime =  getTimeAsDateWithOffset(getCurrentTimeFromDB());	
	}else{
		$currentTime =  getTimeAsDate(getCurrentTimeFromDB());	
	}
	$startTimeAsDate = getTimeAsDate(getStartTimeFromDB($itemID));
	$interval = $currentTime->diff($startTimeAsDate);
	return htmlspecialchars($interval->format('%R %a days %h hours %i minutes %s seconds'));
}

/*
auctionOpen($itemID)
------------------------------------------------------
This function takes an ItemID and returns true or false depending on 
if the auction is open.  The auction is open if the time till it starts is
negative (it started in the past), and the time to end is positive (it will end
in the future)
Params: itemID (integer)
Return: true if open, false if not.
*/
function auctionOpen($itemID){
	$itemID = addslashes($itemID);
	$timeLeft = getTimeLeft($itemID);
	$timeToStart = getTimeToStart($itemID);
	$currentPrice = getCurrentPrice($itemID);
	$buyPrice = getBuyPrice($itemID);
	if($buyPrice != null && $currentPrice >= $buyPrice)return false;
	if(substr($timeLeft, 0, 1) === '-') return false;
	if(substr($timeToStart, 0, 1) === '+')return false;
	return true;
}

/*
getLeader($itemID)
---------------------------------------------------------------------
This function gets the winner of an auction.  It first makes sure that
the auction is not open, and that its start time has already been passed.  
If both conditions are true, then the auction was open for a time and then
closed, which means people have bid on it and the highest bidder will win. 
If nobody has bid then and empty set will be returned.  We find the winner
buy getting the winning price, aka the current price of the closed auction, 
and the itemID.  using those two variables we can determine the winning bid, and 
from that, the winner
Params: the item id to check (int)
Return: the winner id (string)
*/
function getLeader($itemID){
	$itemID = addslashes($itemID);
	$leadingBid = getCurrentPrice($itemID);
	$leader = getLeaderFromDB($leadingBid, $itemID); 
	return htmlspecialchars($leader);
}

?>
