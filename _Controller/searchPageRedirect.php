<?php
include_once('searchScript.php');
$pageSize = 20;
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$text = addslashes($_GET['search']);
	$results = getItemsWithText($text, $pageSize, $currentPage);
	if(count($results) === 1){
		$itemID = $results[0]['ItemID'];
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../item.php?itemid='.$itemID.'">'; 
	}else{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../searchResult.php?text='.$text.'">'; 
	}
}
?>