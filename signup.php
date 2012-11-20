<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Sign In</title>
</head>

<body>
	<form action="createUser.php" method="post">
	    <input type="username" name="username" required="required" placeholder="username"/>
	    <input type="password" name="password" required="required" placeholder="password"/>
	    <input type="password_confirmation" name="password_confirmation" required="required" placeholder="password confirmation"/>
	    <input type="text" name="location" placeholder="location"/>
	    <input type="country" name="country" placeholder="country"/>
	    <input type="submit" value="Submit" />
	</form>

</body>
</html>
