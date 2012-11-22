<?php 
session_start();
include_once('../_Model/sqlitedb.php');
include_once('PasswordHash.php');
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$username = addslashes($_POST['username']);
	$password = addslashes($_POST['password']);
	$password_confirmation = addslashes($_POST['password_confirmation']);
	$location = addslashes($_POST['location']);
	if($password !== $password_confirmation){
		echo '<a href ="index.php">Home</a>';
		exit("password does not match password confirmation");
	}
	if($location === ""){
		$location = null;
	}
	$country = addslashes($_POST['country']);
	if($country === ""){
		$country = null;
	}
	$strongPassword = create_hash($password);
	try
	{
		$query = "insert into User values (:username, 0, :location, :country)";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':location', $location);
		$stmt->bindParam(':country', $country);
		$stmt->execute();

		$query = "insert into UserLogin values (:username, :strongPassword)";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':strongPassword', $strongPassword);
		$stmt->execute();
		$_SESSION['login_user'] = $username;	
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../userHome.php">'; 

	}catch(PDOException $e)
	{
		"SQLite connection failed: " . $e->getMessage();
    	exit();
	}
}
?>
