<?php

include(__DIR__.'/searchScript.php');
$text = $_GET['term'];
$result = getItemsWithText($text, 20, 0);
$array = array();
foreach($result as $r){
		array_push($array, $r['Name']);
}
echo json_encode($array);
?>