<?php 
include_once(__DIR__.'/../_Model/itemHelper.php');
/*
itemScript.php
----------------------------------------------------------------------------------------
This file contains functions that help when creating a new item or dealing with items in general.
The functions check for valid prices and times, get user and itemID, and add new items

Functions
--------------
checkPrices($buyPrice, $firstBid)
checkTime($startTime, $startDate, $endTime, $endDate)
addNewItem($itemName, $buyPrice, $firstBid, $startTime, $startDate, $endTime, $endDate, $description, $userID, $itemID)
getItemID()
*/

/*
checkPrices()
-------------------------------------------------------------
This function makes sure the given price and the buy price are valid. 
First it checks to see if the buy price is not empty.  If it is not then the
bid must be bellow the buy price.  Then it makes sure both values are valid
money strings by comparing them against a regex.  
Params: buy price (real), bid ammount (real)
return: true if valid, false if not
*/
function checkPrices($buyPrice, $bid){
	session_start();
	$regex = '/^([\$]?)([0-9,\s]*\.?[0-9]{0,2})$/';
	if(preg_match($regex, $bid) !== 1){
		$_SESSION['error'] = "Money format is not valid";	
		return false;
	}
	if($buyPrice != ""){
		if(preg_match($regex, $buyPrice) !== 1){
			$_SESSION['error'] = "Money format is not valid";
			return false;
		}
		if($bid >= $buyPrice){
			$_SESSION['error'] = "Bid size is not valid";
			return false;
		}
	}
	return true;
}

/*
checkTime($startTime, $startDate, $endTime, $endDate)
-------------------------------------------------------------
This function makes sure the given times are valid. 
It checks all params against time regexs and makes the the start time
is before the end time
Params: start and end time and date
Return: true if valid, false if not
*/
function checkTime($startTime, $startDate, $endTime, $endDate){
	$regexDate = '/^(19|20)\d\d([- \/.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$/';
	$regexTime = '/^(?:0?[0-9]|1[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/';
	if((preg_match($regexTime, $startTime) !== 1) || (preg_match($regexTime, $endTime) !== 1)){
		$_SESSION['error'] = "Time formats are not valid";	
		return false;
	}
	if((preg_match($regexDate, $startDate) !== 1) || (preg_match($regexDate, $endDate) !== 1)){
		$_SESSION['error'] = "Date formats are not valid";	
		return false;
	}
	if($startDate == $endDate){
		if($startTime >= $endTime){
			$_SESSION['error'] = "Start time must be before end time if the dates are the same";	
			return false;
		}	
	}else if($endDate < $startDate){
		$_SESSION['error'] = "End date must be after start date";	
		return false;
	}
	return true;
}

/*
addNewItem($itemName, $buyPrice, $firstBid, $startTime, $startDate, $endTime, $endDate, $description, $userID, $itemID)
-----------------------------------------------------------------------------------------------------------------------
This function passes all the required fields to the database so it can make a new auction tupple
Params: everything you need to make a new auction tupple
Return:
*/
function addNewItem($itemName, $buyPrice, $firstBid, $startTime, $startDate, $endTime, $endDate, $description, $userID, $itemID){
	addItemToDatabase($itemName, $buyPrice, $firstBid, $startTime, $startDate, $endTime, $endDate, $description, $userID, $itemID);
}

/*
getItemID()
---------------------------------------------------------------------------------------------------------------
This function generates a unique item id for the new item.  It does this by continuously generating a random number and 
checking to see if that number is already an id.  If it is not, then the function breaks out of the loop and returns the id.  
If the number is already an id, the loop goes again.
Params:
Return: valid new item id (int)
*/
function getItemID(){
	while(true){
		$possibleID = mt_rand();
		if(!isAnID($possibleID))return $possibleID;
	}
}

function getNameWithID($itemID){
	return getNameWithIDFromDB($itemID);
}

function getDescriptionWithID($itemID){
	return getDescriptionWithIDFromDB($itemID);
}

function getSeller($itemID){
	return getSellerWithIDFromDB($itemID);
}
?>
