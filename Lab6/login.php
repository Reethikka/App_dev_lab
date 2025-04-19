<?php
session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
	include "db.php";
	$username=$_POST["name"];
	$password=$_POST["password"];
	$stmt=$conn->prepare("SELECT * FROM users WHERE username=?");
	$stmt->bind_param("s",$username);
	$stmt->execute();
	$result=$stmt->get_result();
	if($result->num_rows>0){
		$row=$result->fetch_assoc();
		if($password==$row["password"]){
			$stmt_update=$conn->prepare("UPDATE users SET s_c=s_c+1 WHERE username=?");
			$stmt_update->bind_param("s",$username);
			$stmt_update->execute();
			$current_time=date("Y-m-d H:i:s");
			$stmt_update=$conn->prepare("UPDATE users SET s_t=? WHERE username=?");
			$stmt_update->bind_param("ss",$current_time,$username);
			$stmt_update->execute();
			$stmt_update->close();
			$_SESSION["username"]=$username;
			header("Location:welcome.php");
			exit();

		} else {
			echo "Invalid password";
			$stmt_update=$conn->prepare("UPDATE users SET u_c=u_c+1 WHERE username=?");
			$stmt_update->bind_param("s",$username);
			$stmt_update->execute();
			$current_time=date("Y-m-d H:i:s");
			$stmt_update=$conn->prepare("UPDATE users SET u_t=? WHERE username=?");
			$stmt_update->bind_param("ss",$current_time,$username);
			$stmt_update->execute();
			$stmt_update->close();
			$_SESSION["username"]=$username;
			header("Location:welcome.php");
			exit();
		}
	} else {
		echo "No user found";
		$stmt->close();
		$conn->close();
	}
}

?>


<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
	<form action="" method="POST">
	Name: <input type="text" name="name" is="name" required>
	Password: <input type="password" name="password" id="password" required>
	<input type="submit">
</body>
<a href="register.php" style="display:block;">Register</a>
</html>