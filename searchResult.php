<?php
	include_once('_Controller/checkLogin.php');
	include_once('_Controller/searchScript.php')
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
<ul>
<?php 
$text = $_GET['text'];
$results = getItemsWithText($text, 20, 1);
foreach($results as $r){
?>
<li><?=$r['Name']?></li>
<?php   } ?>
</ul>


<h1> SEARCH RESULT PAGE </h1>
  
</body>
</html>