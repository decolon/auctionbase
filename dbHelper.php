<?php 
require('sqlitedb.php');
function dbSimpleQueryRowArray($select, $from, $where = "")
{
	global $db;
	if($where !== "")
	{
		$query = "select " . $select . " from " . $from . " where " . $where; 
	}else
	{
		$query = "select " . $select . " from " . $from; 
	}

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

function dbSimpleQuerySingleValue($select, $from, $where = "")
{
	global $db;
	if($where !== "")
	{
		$query = "select " . $select . " from " . $from . " where " . $where; 
	}else
	{
		$query = "select " . $select . " from " . $from; 
	}

    try 
    {
		$result = $db->query($query);
		$row = $result->fetch();
		return $row;
    } catch (PDOException $e) 
    {
		echo "Query Failed: " . $e->getMessage();
    }
}
?>
