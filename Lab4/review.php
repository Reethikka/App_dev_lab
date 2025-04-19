<?php
	$cookie_expiration_time=time()+24*60*60;
	$count=file_get_contents('counter.txt');
	if(!isset($_COOKIE['view'])){
		setcookie('view',1,$cookie_expiration_time);
		$count++;
		file_put_contents('counter.txt',$count);
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>Review</title>
<script>
function validateForm(event){
	var review=document.getElementById("review").value;
	var err=document.getElementById("err");
	if(review>5 || review<1){
		err.innerHTML="Enter a valid review";
		event.preventDefault();
		return false;
	}
	return true;
}
</script>
</head>
<body>
	<h1>Rate the book.</h1>
	<img src="image.jpg" alt="book" width="500" height="400" style="display:block; margin:auto">
	<h2>Your visit is noted</h2>
	<?php
		echo "<p>You have visited us $count times today.</p>"
	?>
	<form action="submit.php" method="POST" onsubmit="return validateForm(event)">
	Name: <input type="text" id="name" name="name" required>
	Review (1-5): <input type="text" id="review" name="review" required>
	<input type="submit">
	</form>
	<p id="err"></p>
</body>
</html>