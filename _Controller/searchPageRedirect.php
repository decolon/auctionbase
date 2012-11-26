<?php
/*
searchPageRedirect.php
-----------------------------------------------------------------------------------
This file is responsible for redirecting after searching for an item.  If, when searching,
only one item satisfies the search then the search page will go straight to the item page.  If
there are multiple items that satisfy, then it goes instead to the item list page.

TO DO take care of if there are no items that work
To DO make the item list view
*/
session_start();
include_once('searchScript.php');
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$text = addslashes($_GET['search']);
	$results = getItemsWithText($text);
	if(count($results) === 1){
		$itemID = $results[0]['ItemID'];
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../item.php?itemID='.$itemID.'">'; 
	}else if(count($results) == 0){
		$_SESSION['error'] = "No results found";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php">';
	}else{
		$textArray = array();
		foreach($results as $r){
			array_push($textArray, $r['ItemID']);
		}
		$_SESSION['results']=$textArray;
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../searchResult.php">';
	}
}
?>
