<?php
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
  ?>  
  
  <form action="_Controller/searchPageRedirect.php" method="get">
      <input type="button" value="A"/>
      <input type="text" id="search" name="search" spellcheck="true" placeholder="Search"/>
      <input type="submit"/>
  </form> 
  <form action="_Controller/logInRedirect.php" method="get">
      <input type="submit" value="Sell"/>
  </form>

</body>
</html>


