<?php 
include('sqlitedb.php');
function changeDatabaseTime($newTime){
	global $db;
	try{
		$query = 'update AuctionBaseTime set Auction_Time=:newTime';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':newTime', $newTime);
		$stmt->execute();
	}catch(PDOException $e){
		echo "SQLite connection failed: " . $e->getMessage();
		exit();
	}

}
?>
