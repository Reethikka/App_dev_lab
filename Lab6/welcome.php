<?php
session_start();
include "db.php";
if(isset($_SESSION["username"])){
	echo "Welcome ".$_SESSION["username"];
} else {
	echo "Welcome";
}
$totalUsers=0;
$query="SELECT COUNT(*) AS totalUsers FROM users";
$result=$conn->query($query);
if($result->num_rows>0){
	$row=$result->fetch_assoc();
	$totalUsers=$row["totalUsers"];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>File</title>
</head>
<body>
<marquee direction="left">Welcome to a great community of free resources</marquee>
	<h1>Upload files here</h1>
	<?php
	if(!isset($_SESSION["username"])){
		echo "<a href='login.php'>Upload</a>";
	} else {
		echo "<a href='upload.php'>Upload</a>";
	}
	?>
	<br>
	<h2>List of public files</h2>
	<ul>
	<?php
	$dir="DIR/PUBLIC";
	$public_file_count=0;
	foreach(scandir($dir) as $file){	
		if($file!="." && $file!=".."){
			echo '<li><a href="'.$dir.'/'.$file.'">'.$file.'</a></li>';	
		$public_file_count++;
		}
	}
	?>
	</ul>
	<h2>List of private files</h2>
	<ul>
	<?php
	$dir="DIR/PRIVATE";
	$private_file_count=0;
	foreach(scandir($dir) as $file){	
		if($file!="." && $file!=".."){
			if(!isset($_SESSION["username"])){
				echo '<li><a href="'.'login.php'.'">'.$file.'</a></li>';
			} else {
				echo '<li><a href="'.$dir.'/'.$file.'">'.$file.'</a></li>';	
			}
		$private_file_count++;
		}
	}
	?>
	</ul>
	<p>Total users: <?php echo $totalUsers;?></p>
	<p>Total public files: <?php echo $public_file_count;?></p>
	<p>Total private files: <?php echo $private_file_count;?></p>
<a href="logout.php">Logout</a>
</body>
</html>