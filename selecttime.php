<?php 
/*
selectTime.php
-------------------------------------------------------------------
This file lets an admin select the time for the auctionbase universe

*/
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
  	<label for="realTime">Real Time?</label>
  	<input type="checkbox" id="realTime" name="realTime" value="realTime"/>
  </form>
    
</center>
</html>
