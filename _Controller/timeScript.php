<?php 
include(__DIR__.'/../_Model/timeHelper.php');

function setCurrentTime($newTime){
	changeDatabaseTime($newTime);

}
?>
