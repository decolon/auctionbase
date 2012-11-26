<?php 
/*
bidding.php
--------------------------------------------------------------------------------------
This file includes the form used for bid input.  It is included into the item page when
the user is logged in
*/
?>
<form action="_Controller/newBid.php" method="post">
    <input type="text" name="bidAmount" required="required" placeholder = "Must be greater than <?=$currentPrice?>" size = '40' maxLength='40'/>
    <input type="hidden" value = <?=$itemID?> name = "itemID"/>
    <input type="submit" value = "Bid"/>
</form>

