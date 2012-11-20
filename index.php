<?php 
	include('./logInHelper.php');
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Auction Base</title>
</head>

<body>
  <?php 
  	correctHeader();
  ?>  
  
  <form action="itempage.php">
      <input type="button" value="A"/>
      <input type="text" id="search" spellcheck="true" placeholder="Search"/>
      <input type="submit"/>
  </form> 
  <form action="loginsignup.php">
      <input type="submit" value="Sell"/>
  </form>
  
  <a href="currtime.php">Current Time</a>
  <a href="selecttime.php">Select Time</a>
	
</body>
</html>


