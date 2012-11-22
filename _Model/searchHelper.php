<?php
include_once('dbHelper.php');

function searchByNamePattern($name, $pageSize){
	global $db;
	$query = "select Name from Auction where Name LIKE '".$name."%' LIMIT ".$pageSize;
	try 
    {
		$result = $db->query($query);
		$rowArray = $result->fetchAll();
		return $rowArray;
    } catch (PDOException $e) 
    {
		echo "Query Failed: " . $e->getMessage();
    }
	
}

?>
