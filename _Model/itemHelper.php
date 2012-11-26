<?php 
/*
itemHelper.php
---------------------------------------------------------------------------------------------------
This file contains methods that interact with the database regarding item data.

Functions
----------
addItemToDatabase($itemName, $buyPrice, $firstBid, $startTime, $startDate, $endTime, $endDate, $description, $userID, $itemID)
isAndID($testID)
*/
include_once(__DIR__.'/sqlitedb.php');

/*
addItemToDatabase($itemName, $buyPrice, $firstBid, $startTime, $startDate, $endTime, $endDate, $description, $userID, $itemID)
-------------------------------------------------------------------------------------------------------------------------------
This function takes care of adding a new item into the auction table in the database.
Params: variables to put in the auction table
Return:
*/
function addItemToDatabase($itemName, $buyPrice, $firstBid, $startTime, $startDate, $endTime, $endDate, $description, $userID, $itemID){
	global $db;
	$start = $startDate . " " . $startTime;
	$end = $endDate . " " . $endTime;
	if($buyPrice === ""){
		$query = 'insert into Auction values(:itemID, :name, :firstBid, null, :firstBid, :start, :end, :description, :userID)';
	}else{
		$query = 'insert into Auction values(:itemID, :name, :firstBid, :buyPrice, :firstBid, :start, :end, :description, :userID)';
	}
	
	try{
		$db->beginTransaction();
		$stmt = $db->prepare($query);
		$stmt->bindParam(':itemID', $itemID);
		$stmt->bindParam(':name', $itemName);
		$stmt->bindParam(':firstBid', $firstBid);
		if($buyPrice !== "")$stmt->bindParam(':buyPrice', $buyPrice);
		$stmt->bindParam(':start', $start);
		$stmt->bindParam(':end', $end);
		$stmt->bindParam(':description', $description);
		$stmt->bindParam(':userID', $userID);
		$stmt->execute();
		$db->commit();
	}catch(PDOException $e){
		$db->rollback();
		echo "ERROR" . $e->getMessage();
		exit();
	}
}

/*
isAnID($testID)
-----------------------------------------------------------------------------------
This function takes a possible new id and makes sure that no other item in the 
database has that same id.  It queries the database for an item with the
test id.  if the query returns nothing then this function returns true.
Params: a test id (int)
Return: true if the id is unique, false if its not
*/
function isAnID($testID){
	global $db;
	try{
		$db->beginTransaction();
		$query = 'select ItemID from Auction where ItemID = :testID';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':testID', $testID);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$db->commit();
		if(count($result) == 0)return false;
		return true;

	}catch(PDOException $e){
		$db->rollback();
		echo "The Error Is" . $e->getMessage();
		exit();
	}
}

function getNameWithIDFromDB($itemID){
	global $db;
	try{
		$db->beginTransaction();
		$query = "select Name from Auction where ItemID = :itemID";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':itemID', $itemID);
		$stmt->execute();
		$result = $stmt->fetch();
		$db->commit();
		return $result['Name'];
	}catch(PDOException $e){
		$db->rollback();
		echo "ERROR " . $e->getMessage();
		exit();
	}
}
function getDescriptionWithIDFromDB($itemID){
	global $db;
	try{
		$db->beginTransaction();
		$query = "select Description from Auction where ItemID = :itemID";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':itemID', $itemID);
		$stmt->execute();
		$result = $stmt->fetch();
		$db->commit();
		return $result['Description'];
	}catch(PDOException $e){
		$db->rollback();
		echo "ERROR " . $e->getMessage();
		exit();
	}
}

function getSellerWithIDFromDB($itemID){
	global $db;
	try{
		$db->beginTransaction();
		$query = "select UserID from Auction where ItemID = :itemID";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':itemID', $itemID);
		$stmt->execute();
		$result = $stmt->fetch();
		$db->commit();
		return $result['UserID'];
	}catch(PDOException $e){
		$db->rollback();
		echo "ERROR " . $e->getMessage();
		exit();
	}
}



?>
