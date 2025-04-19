<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_FILES["file"])){
	$file=$_FILES["file"];
	$category=$_POST["category"];
	$target_dir=$category==="public"?"DIR/PUBLIC":"DIR/PRIVATE";
	$target_file=$target_dir."/".basename($file["name"]);
	if(move_uploaded_file($file["tmp_name"],$target_file)){
		echo "Upload successful";
	} else {
		echo "Upload failure";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload</title>
</head>
<body>
<h2>Upload file</h2>
<form action="" method="POST" enctype="multipart/form-data">
	Choose file: <input name="file" type="file" id="file" required>
	<br>
	Select category: <select id="category" name="category">
	<option value="public">Public</option>
	<option value="private">Private</option>
	</select>
	<button type="submit">Submit</button>
</form>
<a href="welcome.php">Home</a>
</body>