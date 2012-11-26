<?php
/*
searchHelper.php
---------------------------------------------------------------------------
This file contains functions to help with searching

Functions
----------------------
searchByNamePattern($name, $pageSize)
*/
include_once('dbHelper.php');

/*
searchByNamePattern($name, $pageSize)
--------------------------------------------------------------------------
This function searches the database to see if any item's name begins with the
parameter $name
Params: the text to check for (string). the page size to return
Return: array of items whos name starts with the text in $name
TO DO implement pagination

*/
function searchByNamePattern($name){
	global $db;
	$query = html_entity_decode("select Name, ItemID from Auction where Name LIKE '".$name."%' LIMIT 50");
	try 
    {
		$db->beginTransaction();
		$stmt = $db->prepare($query);
		$stmt->execute();
		$array = $stmt->fetchAll();
		$db->commit();
		return $array;
    } catch (PDOException $e) 
    {
		$db->rollback();
		echo "Query Failed: " . $e->getMessage();
		exit();
    }
	
}

function advancedSearchDB($query, $name, $sellerID, $price){
	global $db;
	if($query === "")return array();
	$query .= " LIMIT 50";
	$name = html_entity_decode($name);

	try 
    {
		$db->beginTransaction();
		$stmt = $db->prepare($query);
		if($name !== ""){
			$stmt->bindParam(':name', $name);
		}
		if($sellerID !== ""){
			$stmt->bindParam(':sellerID', $sellerID);
		}
		if($price !== ""){
			$stmt->bindParam(':price', $price);
		}
		$stmt->execute();
		$rowArray = $stmt->fetchAll();
		$db->commit();
		return $rowArray;
    } catch (PDOException $e) 
    {
		$db->rollback();
		echo "Query Failed: " . $e->getMessage();
		exit();
    }
}

?>
