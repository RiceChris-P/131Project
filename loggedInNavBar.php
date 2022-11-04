<?php
	$conn = mysqli_connect("localhost","root", "","cmpe131");
	if(!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}
	$sql="SELECT fname FROM accounts WHERE loginStatus=true;";
	$results= mysqli_query($conn,$sql);
	$temp= mysqli_fetch_assoc($results);
	$fname= $temp["fname"];
?>
<html>
	<link rel="stylesheet" href="navstyle.css">
	<link rel="stylesheet" href="loginForNavBar.css">
	<ul>
			<img class="logo" src="assets/logo-transparent.png" alt="">
			<li>
			<div class="dropdown"><button class="dropdownbtn"><?php echo $fname;?></button>
			<div class="dropdownmenu">
			<a href="account.php">account</a>
			<a href="orders.php">orders</a>
			<a href="signout.php">signout</a>
			</div>
</div>
			<li><a href="shop.php">Shop</a></li>
			<li><a href="aboutus.html">About Us</a></li>
			<li><a href="index.html">Home</a></li>
	</ul>
</html>