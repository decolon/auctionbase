<?php 

/*
timeHelper.php
---------------------------------------------------------------------------------------------------
This file contains functions that interact with the time elements in the database

Functions
-----------
dbSimpleQuerySingleValue($select, $from, $where = "")
getCurrentTimeFromDB()
getEndTimeFromDB($itemID)
getStartTimeFromDB($itemID)
startTimerStart()
deleteTimerStart()
getTimerStart()
getDatetimeNow()
*/
include('sqlitedb.php');

/*
changeDatabaseTime($newTime)
----------------------------------------------------------------------------------------------
This function replaces the current Auction_Time string with the input string.
Params: new time string
Return:
*/
function changeDatabaseTime($newTime){
	global $db;
	try{
		$db->beginTransaction();
		$query = 'update AuctionBaseTime set Auction_Time=:newTime where Auction_Time is not null';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':newTime', $newTime);
		$stmt->execute();
		$db->commit();
	}catch(PDOException $e){
		$db->rollback();
		echo "SQLite connection failed: " . $e->getMessage();
		exit();
	}

}

/*
getCurrentTimeFromDB()
----------------------------------------------------------------------------------------------
This function returns the current Auction_Time string from the database.
Params:
Return: current time (string)
*/
function getCurrentTimeFromDB(){
	global $db;
	try{
		$db->beginTransaction();
		$query = "select Auction_Time from AuctionBaseTime where Auction_Time is not null";
		$result = $db->query($query);
		$row = $result->fetch();
		$db->commit();
		return $row['Auction_Time'];
	}catch(PDOException $e){
		$db->rollback();
		echo "Error" . $e->getMessage();
		exit();
	}

}

/*
getEndTimeFromDB($itemID)
----------------------------------------------------------------------------------------------
This function returns the End_Time value for a specific item
Params: item id of item to check
Return: End_Time value (string)
*/
function getEndTimeFromDB($itemID){
	global $db;
	try{
		$db->beginTransaction();
		$query = "select End_Time from Auction where ItemID = '".$itemID."'";
		$result = $db->query($query);
		$row = $result->fetch();
		$db->commit();
		return $row['End_Time'];
	}catch(PDOException $e){
		$db->rollback();
		echo "Error" . $e->getMessage();
		exit();
	}
}

/*
getStartTimeFromDB($itemID)
----------------------------------------------------------------------------------------------
This function returns the Start_Time value for a specific item
Params: item id of item to check
Return: Start_Time value (string)
*/
function getStartTimeFromDB($itemID){
	global $db;
	try{
		$db->beginTransaction();
		$query = "select Start_Time from Auction where ItemID = '".$itemID."'";
		$result = $db->query($query);
		$row = $result->fetch();
		$db->commit();
		return $row['Start_Time'];
	}catch(PDOException $e){
		$db->rollback();
		echo "Error" . $e->getMessage();
		exit();
	}
}

/*
startTimeStart()
-----------------------------------------------------------------------------
This function starts the real time feature.  It inserts into the AuctionBaseTime
table the tupple null, datetime('now').  The null is so there is no confusion with
the Auction_Time, the datetime('now') is the beginning of our timer.  We will add 
into current time the difference between current time in real life and the 
TimerStart value
Params:
Return:
*/
function startTimerStart(){
	global $db;
	try{
		$db->beginTransaction();
		$query = "insert into AuctionBaseTime values(null, datetime('now'))";
		$result = $db->query($query);
		$db->commit();
	}catch(PDOException $e){
		$db->rollback();
		echo "Error" . $e->getMessage();
		exit();
	}
}

/*
deleteTimerStart()
------------------------------------------------------------------------
This function deletes the tupple with TimerStart set, thereby stopping the
real time functionality
Params:
Return:
*/
function deleteTimerStart(){
	global $db;
	try{
		$db->beginTransaction();
		$query = "delete from AuctionBaseTime where TimerStart is not null";
		$db->query($query);
		$db->commit();
	}catch(PDOException $e){
		$db->rollback();
		echo "Error" . $e->getMessage();
		exit();
	}
}

/*
getTimeStart()
---------------------------------------------------------------------------
This function returns the value of the set TimerStart so we can figure out the
displacement by subtracting the value from right now in real life. 
Params:
Return: the value in TimerStart (string)
*/
function getTimerStart(){
	global $db;
	try{
		$db->beginTransaction();
		$query = "select TimerStart from AuctionBaseTime where TimerStart is not null";
		$result = $db->query($query);
		$row = $result->fetch();
		$db->commit();
		return $row['TimerStart'];
	}catch(PDOException $e){
		$db->rollback();
		echo "Error" . $e->getMessage();
		exit();
	}
}

/*
getDateTieNow()
-------------------------------------------------------------------------------
This function returns the current time in real life.  This is used to calculate the
displacement to add to Auction_Base time.
Params:
Return: current time in real life
*/
function getDatetimeNow(){
	global $db;
	try{
		$db->beginTransaction();
		$query = "select datetime('now') as now";
		$result = $db->query($query);
		$row = $result->fetch();
		$db->commit();
		return $row['now'];
	}catch(PDOException $e){
		$db->rollback();
		echo "Error" . $e->getMessage();
		exit();
	}
}



?>
