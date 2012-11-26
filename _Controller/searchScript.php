<?php
/*
searchScript.php
-------------------------------------------------------------------
This file contains functions that help in searching.

TO DO see if you can get rid of this file.  
*/
include_once('itemScript.php');
include_once (__DIR__.'/../_Model/searchHelper.php');
function getItemsWithText($text){
	return searchByNamePattern($text);
}

function processAdvancedSearch($name, $sellerID, $price){
	if($name !== ""){
		$itemName = "Name LIKE :name";
		$name .= '%';
	}
	if($sellerID !== ""){
		$seller = "UserID LIKE :sellerID";
		$sellerID .= '%';
	}
	if($price !== "" && checkPrices("", $price)){
		$itemPrice = "Current_Price = :price";
	}else{
		$price = "";	
	}
	$query = getQuery($itemName, $seller, $itemPrice);
	return advancedSearchDB($query, $name, $sellerID, $price);
}


function getQuery($itemName, $seller, $price){
	$query = "select ItemID from Auction where ";
	if(isset($itemName)){
		$query .= $itemName;
		if(isset($seller)){
			$query .= (" AND " . $seller);
			if(isset($price)){
				$query .= (" AND " . $price);
			}
		}else{
			if(isset($price)){
				$query .= (" AND " . $price);
			}
		}
	}else{
		if(isset($seller)){
			$query .= $seller;
			if(isset($price)){
				$query .= (" AND " . $price);
			}
		}else{
			if(isset($price)){
				$query .= $price;
			}else{
				$query = "";	
			}
		}
	}
	return $query;
}

?>
