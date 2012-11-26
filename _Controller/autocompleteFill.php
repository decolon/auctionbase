<?php
/*
autocompleteFill.php
---------------------------------------------------
This file is responsible for getting the Auction items
with Names starting with the text from the text field.
It first gets the entered text, then gets a list of all
items that begin with that text, then it populates an array
with all the items that are in open auctions.  finally it returns
json data to the calling jquery function so the data will be 
displayed under the text field.  
*/
include_once(__DIR__.'/searchScript.php');
include_once(__DIR__.'/biddingScript.php');
$text = addslashes($_GET['term']);
$result = getItemsWithText($text, 20, 0);
$array = array();
foreach($result as $r){
	//if(auctionOpen($r['ItemID'])){
		array_push($array, htmlspecialchars($r['Name']));	
	//}
}
echo json_encode($array);
?>
