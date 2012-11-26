<?php 
/*
dbHelper.php
-------------------------------------------------------------------
This file contains functions that help in querying the database

Functions
------------
dbSimpleQueryRowArray($select, $from, $where = "")
dbSimpleQuerySingleValue($select, $from, $where = "")
*/
require(__DIR__.'/sqlitedb.php');

/*
dbSimpleQueryRowArray($select, $from, $where = "")
--------------------------------------------------------------------------
This function queries the database using the giben parameters.  If where parameter is
not provided then the where clause is omitted from the query.  Results are given as an
array of results
Params: text from the select, from and where clauses
Return: array of values given by the database
*/
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
		$db->beginTransaction();
		$result = $db->query($query);
		$rowArray = $result->fetchAll();
		$db->commit();
		return $rowArray;
    } catch (PDOException $e) 
    {
		$db->rollback();
		echo "Query Failed: " . $e->getMessage();
		exit();
    }
}

/*
dbSimpleQuerySingleValue($select, $from, $where = "")
--------------------------------------------------------------------------
This function queries the database using the giben parameters.  If where parameter is
not provided then the where clause is omitted from the query.  Only the first value from
the database is returned
Params: text from the select, from and where clauses
Return: first value given by the database
*/
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
		$db->beginTransaction();
		$result = $db->query($query);
		$row = $result->fetch();
		$db->commit();
		return $row;
    } catch (PDOException $e) 
    {
		$db->rollback();
		echo "Query Failed: " . $e->getMessage();
		exit();
    }
}
?>
