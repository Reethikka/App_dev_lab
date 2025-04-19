<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	include "db.php";
	$username=$_POST["name"];
	$password=$_POST["password"];
	$stmt=$conn->prepare("SELECT * FROM users WHERE username =?");
	$stmt->bind_param("s",$username);
	$stmt->execute();
	$result=$stmt->get_result();
	if($result->num_rows>0){
		echo "Username already exists";
		$stmt->close();	
		$conn->close();
		exit();
	}
	$stmt=$conn->prepare("INSERT INTO users(username,password) VALUES(?,?);");
	$stmt->bind_param("ss",$username,$password);
	if($stmt->execute()){
		echo "User added successfully";
	} else {
		echo "Error adding user";
	}
	$stmt->close();
	$conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<script>
	function validateForm(event){
		password=document.getElementById("password").value;
		err=document.getElementById("err");
		var regexpUpper="/[A-Z]/";
		var regexpLower="/[a-z]/";
		var regexpDigit="/\d/";
		if(password.length<8 || !regexpUpper.test(password) || !regexpLower.test(password) || !regexpDigit.test(password)){
			err.innerHTML="<b>Enter the password according to rules</b>";
			event.preventDefault();
			return false;
		}
		return true;
	}
</script>
</head>
<body>
	<form action="" method="POST" onsubmit="return validateForm(event)">
	Name: <input type="text" name="name" is="name" required>
	Password: <input type="password" name="password" id="password" required>
	<input type="submit"></body>
<p id="err"></p>
<a href="login.php">Login</a>
</html>