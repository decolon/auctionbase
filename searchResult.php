<?php
/*
searchResult.php
----------------------------------------------------------------
This file gives a list view of all the items which satisfy a searchs 
criteria

TO DO implement it
*/
	include_once('_Controller/checkLogin.php');
	include_once('_Controller/itemScript.php')
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php 
	correctHeader();
?> 
<h1> SEARCH RESULT PAGE </h1>
<ul>
<?php 
	if(isset($_SESSION['results'])){
		foreach($_SESSION['results'] as $r){
			$itemID = $r;
			$itemName = getNameWithID($itemID);
?>
		<li><a href="item.php?itemID=<?=$itemID?>"><?=htmlspecialchars($itemName)?></a></li>
<?php
		}			
	}
?>
</ul>
  
</body>
</html>
