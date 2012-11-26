<?php 
/*
timeScript.php
----------------------------------------------------------------------------
this file contains functions that assist in managing the time in the auction, mostly
with managing the real time feature of the site.  

Functions
----------
setCurrentTime($newTime)
startRealTime()
endRealTime()
useRealTime()
getTimeAsDate($toConvert)
getTimeAsDateWithOffset($toConvert)
*/
include(__DIR__.'/../_Model/timeHelper.php');

//The time zone where the application is being used
$timeZone = 'America/Los_Angeles';

/*
setCurrentTime($newTime)
-----------------------------------------------------------------
This function passes on to the database a string $newTime, which will
be used to set Auction_Time in the AuctionBaseTime table
Params: the new time
Return:
*/
function setCurrentTime($newTime){
	$newTime = addslashes($newTime);
	changeDatabaseTime($newTime);
}

/*
startRealTime()
-----------------------------------------------------------------------
This function starts the real time feature.  First it clears out the previous
timer start so that the additional time added from the real time feature will
reflect the time since this method was called. After deleting the TimerStart it 
then creats a new start.
Params:
Return:
*/
function startRealTime(){
	endRealTime();
	startTimerStart();
	
}

/*
endRealTime()
--------------------------------------------------------------------------------
This function ends the real time feature by going to the database and deleating
all tupples with TimerStart column set.
Params:
Return:
*/
function endRealTime(){
	deleteTimerStart();
}

/*
useRealTime()
----------------------------------------------------------------------
This function returns true if the real time feature is activated and false
if it is not.  It determins if the feature is activated by checking if any
TimerStart tupple is in the database.  If there are none, then the feature
is turned off.
Params:
Return: true if the feature is on, false if it is not.
*/
function useRealTime(){
	$timerStartNull = getTimerStart();
	if(count($timerStartNull)==0)return false;
	return true;
}

/*
getTimeAsDate($toConvert)
-----------------------------------------------------------------------------
This function takes a time string from the database and turns it into a 
php datetime object.  It uses the variable $timeZone as the time zone value.
Params: time string to convert (string)
Return: php datetime object containing the time string (DateTime Object)
*/
function getTimeAsDate($toConvert){
	global $timeZone;
	$timeDate = new DateTime($toConvert, new DateTimeZone($timeZone));
	return $timeDate;
}
/*
getTimeAsDateWithOffset($toConvert)
-----------------------------------------------------------------------------
This function takes a time string from the database and turns it into a 
php datetime object.  It also adds onto this datetime object the displacement
from the real time feature.  It uses the variable $timeZone as the time zone value.
Params: time string to convert (string)
Return: php datetime object containing the time string and offset by real time(DateTime Object)
*/
function getTimeAsDateWithOffset($toConvert){
	global $timeZone;
	$startTimeDate = new DateTime($toConvert, new DateTimeZone($timeZone));
	$timerStart = new DateTime(getTimerStart(), new DateTimeZone($timeZone));
	$now = new DateTime(getDatetimeNow(), new DateTimeZone($timeZone));
	return $startTimeDate->add($timerStart->diff($now));
	
}

?>
