<?php 
include_once('searchScript.php');
include_once('../_Model/itemHelper.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if($_GET['itemID'] !== null){
		$itemID = addslashes($_GET['itemID']);
		$isAnItem = isAnID($itemID);
		if($isAnItem == false ){
			$_SESSION['error'] = "No results found";
			header('Location: ../advancedSearch.php');		
		}else{
			header('Location: ../item.php?itemID='.$itemID);
		}
	}else{
		$name = addslashes($_GET['name']);
		$sellerID = addslashes($_GET['sellerID']);
		$price = addslashes($_GET['price']);
		$results = processAdvancedSearch($name, $sellerID, $price);
		if(count($results) == 1){
			header('Location: ../item.php?itemID='.$results[0]['ItemID']);
		}else if(count($results) == 0){
			$_SESSION['error'] = "No results found";
			header('Location: ../advancedSearch.php');		
		}else{
		  $textArray = array();
		  foreach($results as $r){
			  array_push($textArray, $r['ItemID']);
		  }
		  $_SESSION['results']=$textArray;
		  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../searchResult.php">';	
		}

	}
	
}

?>
