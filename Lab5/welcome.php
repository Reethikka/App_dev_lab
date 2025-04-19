<?php
session_start();
if(!isset($_SESSION["username"])){
	header("Location:login.php");
}
echo "Welcome ".$_SESSION["username"];
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome</title>
</head>
<body>
<a href="logout.php">Logout</a>
</body>
</html>