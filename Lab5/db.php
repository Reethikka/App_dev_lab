<?php
	$servername="localhost";
	$username="root";
	$password="";
	$dbName="user_auth_1";
	$conn=new mysqli($servername,$username,$password,$dbName);
	if($conn->connect_error){
		die("Error connecting to database".$conn->connect_error);
	}
?>