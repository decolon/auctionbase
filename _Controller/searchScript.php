<?php
include_once (__DIR__.'/../_Model/searchHelper.php');
function getItemsWithText($text, $pageSize, $currentPage){
	return searchByNamePattern($text, $pageSize);
}

function getItemWithID($currentPage){
	global $text, $pageSize;
	return getItemsFromDbWithText($text, $pageSize, $currentPage);
}
?>