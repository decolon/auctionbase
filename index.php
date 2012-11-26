<?php
/*
index.php
------------------------------------------------------
Home sweet home
*/
	include_once('_Controller/checkLogin.php');
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<script src="_js/jquery-ui-1.9.1.custom/js/jquery-1.8.2.js"></script>
<script src="_js/jquery-ui-1.9.1.custom/js/jquery-ui-1.9.1.custom.min.js"></script>
<script src="_js/searchAutocomplete.js"></script>
<title>Auction Base</title>
</head>

<body>
  <?php 
  	correctHeader();
	if(isset($_SESSION['error'])){
		echo '<h1>'. htmlspecialchars($_SESSION['error']).'</h1>';
		$_SESSION['error'];	
	}
  ?>  
  
  <form action="_Controller/searchPageRedirect.php" method="get">
  	<a href = "advancedSearch.php">Advanced</a>
      <input type="text" id="search" name="search" spellcheck="true" placeholder="Search"/>
      <input type="submit"/>
  </form> 
  <form action="_Controller/logInRedirect.php" method="get">
      <input type="submit" value="Sell"/>
  </form>

</body>
</html>


