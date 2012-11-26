<?php 
/*
biddingHelper.php
--------------------------------------------------------------------------------
This file contains functions that help with the creation of bids.

Functions
-----------
currentPriceFromDB($itemID)
buyPriceFromDB($itemID)
insertNewBid($userID, $currentTime, $itemID, $newPrice)
*/
include_once(__DIR__.'/sqlitedb.php');

/*
currentPriceFromDB($itemID)
-----------------------------------------------------------------------
This function looks up an items current price from the db and returns it
Param: item id of item to check
Return: items current price
*/
function currentPriceFromDB($itemID){
	global $db;
	try{
		$db->beginTransaction();
		$query = 'select Current_Price from Auction where ItemID = :itemID';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':itemID', $itemID);
		$stmt->execute();
		$row = $stmt->fetch();
		$db->commit();
		return $row['Current_Price'];
	}catch(PDOException $e){
		$db->rollback();
		echo "ERROR" . $e->getMessage();
		exit();
	}

}

/*
buyPriceFromDB($itemID)
-----------------------------------------------------------------------
This function looks up an items buy price from the db and returns it
Param: item id of item to check
Return: items buy price, null if no buy price
*/
function buyPriceFromDB($itemID){
	global $db;
	try{
		$db->beginTransaction();
		$query = 'select Buy_Price from Auction where ItemID = :itemID';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':itemID', $itemID);
		$stmt->execute();
		$row = $stmt->fetch();
		$db->commit();
		return $row['Buy_Price'];
	}catch(PDOException $e){
		$db->rollback();
		echo "ERROR" . $e->getMessage();
		exit();
	}
}

/*
insertNewBid($userID, $currentTime, $itemID, $newPrice)
-----------------------------------------------------------------------
This function inserts a new bid into the database
Param: userID of bidder, current time, id of itom, and bid ammount
Return: 
*/
function insertNewBid($userID, $currentTime, $itemID, $newPrice){
	$currentTime = $currentTime->format('Y-m-d H:i:s');
	global $db;
	try{
		$db->beginTransaction();
		$query = 'insert into Bids values(:userID, :time, :itemID, :bidAmount)';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':userID', $userID);
		$stmt->bindParam(':time', $currentTime);
		$stmt->bindParam(':itemID', $itemID);
		$stmt->bindParam('bidAmount', $newPrice);
		$stmt->execute();

		$query = 'update Auction set Current_Price = :newPrice where ItemID = :itemID';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':newPrice', $newPrice);
		$stmt->bindParam(':itemID', $itemID);
		$stmt->execute();
		$db->commit();
	}catch(PDOException $e){
		$db->rollback();
		echo "ERROR" . $e->getMessage();
		exit();
	}
}

/*
getLeaderFromDB($winningPrice, $itemID)
-----------------------------------------------------------------------
This function queries the db to find the bid with the winning price and 
the item id that are the same as the given parameters.  
Params: winning bid and the item id
Return: the id of the winner
*/

function getLeaderFromDB($leadingBid, $itemID){
	global $db;
	try{
		$db->beginTransaction();
		$query = 'select UserID from Bids where ItemID = :itemID AND Bid_Amount = :leadingBid';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':itemID', $itemID);
		$stmt->bindParam(':leadingBid', $leadingBid);
		$stmt->execute();
		$row = $stmt->fetch();
		$db->commit();
		return $row['UserID'];
	}catch(PDOException $e){
		$db->rollback();
		echo "ERROR" . $e->getMessage();
		exit();
	}
}

?>
