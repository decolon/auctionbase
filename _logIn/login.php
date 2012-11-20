<?php include('dbHelper.php');?>
<!doctype html>
<html>
<head>
<title>WORK</title>
</head>
<body>
<?php 
session_start();
echo "start";
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$userName = addslashes($_POST['Username']);
	$password = addslashes($_POST['Password']);

	$rowArray = dbSimpleQueryRowArray("*", "UserLogin", "UserID = ".$userName." and Password = ".$password);
	$rowCount = $rowArray['count'];
	echo "before if";
	if($rowCount === 1)
	{
		$_SESSION['login_user'] = $userName;
		echo "win";
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=userHome.php">';
	}else{
		echo "The username or password is invalid";
	}
}
else{echo "no if";}
?>
</body>
</html>
