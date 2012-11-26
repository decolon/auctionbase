<?php 
	include_once('_Controller/checkLogin.php');
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Advanced Search</title>
    </head>
    <body>
    <?php 
		correctHeader(); 
		if(isset($_SESSION['error'])){
			echo '<h1>' .htmlspecialchars($_SESSION['error']).'</h1>';
			$_SESSION['error']	= null;
		}
	?>
    	<form action="_Controller/advancedSearch.php" method="get">
    	    Name: <input type="text" name="name" value="" /></br>
    	    Seller ID: <input type="text" name="sellerID"/></br>
    	    Price $<input type="text" name="price" value="" /></br>
    		<input type="submit" value="Submit" />
	   	</form>
		</br>
		</br>
		OR
		</br>
		</br>
		</br>
		</br>
    	<form action="_Controller/advancedSearch.php" method="get">
    	    Item ID: <input type="text" name="itemID" value="" /></br>
    	    <input type="submit" value="Submit" />
    	</form>
    
    
    </body>
</html>
