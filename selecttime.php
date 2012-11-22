<?php # currtime.php - show current time
  include_once('_Controller/checkLogin.php');
  include_once('_Controller/timeScript.php');
?>
<html>
<head>
<title>AuctionBase</title>
</head>

<?php 
 correctHeader();
?> 

<center>
<h3> Select a Time </h3> 

  <form method="POST" action="_Controller/updateTime.php">
  <?php 
    include_once ('timetable.html');
  ?>
  </form>
    
</center>
</html>
