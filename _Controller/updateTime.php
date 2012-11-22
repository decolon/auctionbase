<?php 
include_once(__DIR__.'/timeScript.php');
	 $MM = $_POST["MM"];
    $dd = $_POST["dd"];
    $yyyy = $_POST["yyyy"];
    $HH = $_POST["HH"];
    $mm = $_POST["mm"];
    $ss = $_POST["ss"];    
    $entername = htmlspecialchars($_POST["entername"]);
    
    if($_POST["MM"]) {
      $selectedtime = $yyyy."-".$MM."-".$dd." ".$HH.":".$mm.":".$ss;
      setCurrentTime($selectedtime);
	  header("Location: ../currtime.php");
   }
?>
