<?php 
include_once('sqlitedb.php');


function insertNewUserIntoDB($username, $password, $location, $country){
	session_start();
	global $db;
	try
	{
		$db->beginTransaction();
	  $query = "insert into User values (:username, 0, :location, :country)";
	  $stmt = $db->prepare($query);
	  $stmt->bindParam(':username', $username);
	  $stmt->bindParam(':location', $location);
	  $stmt->bindParam(':country', $country);
	  $stmt->execute();
  
	  $query = "insert into UserLogin values (:username, :password, 0)";
	  $stmt = $db->prepare($query);
	  $stmt->bindParam(':username', $username);
	  $stmt->bindParam(':password', $password);
	  $stmt->execute();
	  $_SESSION['login_user'] = $username;
	  $db->commit();
	  header('Location: ../userHome.php'); 
	}catch(PDOException $e)
	{
		$db->rollback();
		echo "SQLite connection failed: " . $e->getMessage();
		exit();
	}
}

function isUnique($username){
	global $db;
	try{
		$db->beginTransaction();
		
		$query = "select UserID from User where UserID = :username";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		if ($result === null) {
        	throw new Exception("stmt->fetch returned null");
      	}
		$db->commit();
		if(count($result) == 0)return true;
		$_SESSION['error'] = "Username is not unique";
		return false;
	}catch(Exception $e){
		try{
			$db->rollback();
		}catch(PDOException $epdo){
			echo "SQLite Error " . $epdo->getMessages();
		}
		echo "Transaction Failed " . $e->getMessage();
		exit();
	}
	
}

function sellerHasLocation($userID){
	global $db;
	session_start();
	try{
		$db->beginTransaction();
		$query = "select UserID from User where UserID = :userID AND (Location is not null AND Country is not null)";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':userID', $userID);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$db->commit();
		if(count($result) == 0){
			$_SESSION['error'] = "A Seller must have location and country in thier user information";
			return false;
		}	
		return true;
	}catch(PDOException $e){
		$db->rollback();
		echo "PDOException " . $e->getMessage();
		exit();	
	}
}










?>