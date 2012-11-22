<?php # currtime.php - show current time
  include_once('_Controller/checkLogin.php');
?>

<html>
<head>
<title>AuctionBase</title>
</head>

<?php 
 correctHeader();
?> 

<center>
<h3> Current Time </h3> 

<?php
  $query = "select Auction_Time from AuctionBaseTime";
  
  try {
    $result = $db->query($query);
    $row = $result->fetch();
    echo "Current time is: ".htmlspecialchars($row["Auction_Time"]);
  } catch (PDOException $e) {
    echo "Current time query failed: " . $e->getMessage();
  }
  
  $db = null;
?>
</center>
</html>

