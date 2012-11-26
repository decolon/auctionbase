<?php
/*
item.php
--------------------------------------------------------
this file displays information on a specific item.  You can 
get to it by searching for a specific item, clicking on an item
in the searchResult page, or putting a new item up for sale.

Bidding is only available to logged in users
*/
include_once('_Controller/checkLogin.php'); 
include_once('_Controller/biddingScript.php');
include_once('_Controller/itemScript.php');
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php correctHeader();?>
<h1> Item Page </h1>
<?php 
if(isset($_SESSION['error'])){
	echo '<h1>'.htmlspecialchars($_SESSION['error']).'</h1>';
	$_SESSION['error'] = null;
}
$itemID= addslashes($_GET['itemID']);
$currentPrice = getCurrentPrice($itemID);
$auctionOpen = auctionOpen($itemID);
$loggedIn = loggedIn();
?>
<p>Current Price = <?=htmlspecialchars($currentPrice)?></p>
<?php
if($loggedIn && $auctionOpen){
	include_once('bidding.php');
}else if($auctionOpen && !$loggedIn){
	echo "</br>";
	echo "<h1>SIGN IN TO BID</h1>";
	echo "</br>";
}
$timeLeft = getTimeLeft($itemID);
$timeSinceStart = getTimeToStart($itemID);
$leader = getLeader($itemID);
$buyPrice = getBuyPrice($itemID);
$name = getNameWithID($itemID);
$seller = getSeller($itemID);
$description = getDescriptionWithID($itemID);
echo "ITEM ID   " . htmlspecialchars($itemID). '</br>';
echo "NAME  " . htmlspecialchars($name) . '</br>';
echo "SELLER  " .htmlspecialchars($seller) . '</br>';
if($buyPrice != ""){
	echo "    Buy Price " . htmlspecialchars($buyPrice) . "</br>";
}
if($auctionOpen){
	echo OPEN;
}else{
	echo CLOSED;
}
?>
<p>Time since start = <?=htmlspecialchars($timeSinceStart)?></p>
<p>Time left = <?= htmlspecialchars($timeLeft) ?></p>
<?php 
	if(!$auctionOpen && $leader !== ""){
		echo "Winner is  ". htmlspecialchars($leader);
	}else if($leader != ""){
		echo "Leader is " . htmlspecialchars($leader);
	}
?>
<p>Description:  <?= htmlspecialchars($description) ?></p>


</body>
</html>
