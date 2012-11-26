<?php 
/*
sellItem.php
----------------------------------------------------------------------
This file displaysthe form to put a new item up for sale.  
*/
include('_Controller/checkLogin.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Sell New Item</title>
</head>

<body>
<?php correctHeader(); ?>
<h1> Selling new item </h1>

<?php 
if(isset($_SESSION['error'])){
	echo '<h1>'.htmlspecialchars($_SESSION['error']).'</h1>';
	$_SESSION['error'] = null;
}
?>
<form action="_Controller/newItem.php" method="post">
    Item Name: <input type="text" name="itemName" value="" required placeholder="Item Name"/></br>
    Buy Price: <input type="text" name="buyPrice" value="50" placeholder="Buy Price"></br>
    First Bid: <input type="text" name="firstBid" value="10" required placeholder="Start Price"/></br>
    Start Time: <input type="time" name="startTime" value="01:00:00" required /></br>
    Start Date: <input type="date" name="startDate" value="2001-12-10" required/></br>
    End Time: <input type="time" name="endTime" value="01:00:00" required/></br>
    End Date: <input type="date" name="endDate" value="2001-12-17" required/></br>
	Description: <textarea name="description" placeholder="Description" required cols="50" rows="4">Description</textarea></br>
	<input type="submit" value="Submit"/>
</form>

</body>
</html>
