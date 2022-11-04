<?php
	$conn = mysqli_connect("localhost","root", "","cmpe131");
	if(!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}
	$sql="SELECT fname FROM accounts WHERE loginStatus=true;";
	$results= mysqli_query($conn,$sql);
	$temp= mysqli_fetch_assoc($results);
	$fname= $temp["fname"];
	$num = mysqli_num_rows($results); 
?>

<html>
	<head>
		<link rel="stylesheet" href="../style/navbar.css">
	</head>
	<nav class="navBar">
		<ul>
			<a href="index.php"><img class="navLogo" src="../assets/logo-transparent.png" alt=""></a>
			<li class="cartPreview">	
				<button class="cartPreviewButton" onclick="showCart()">
					<img class="cartPreviewImage" src="../assets/cart.png" alt=""> 
					<p class="cartPreviewText" id="cartPreviewText" >$0.00</p>
				</button>
			</li>
			<?php if($num==1){?>
				<div class="dropdown">
					<button class="dropdownbtn"><?php echo $fname;?></button>
						<div class="dropdownmenu">
							<a href="account.php">account</a>
							<a href="orders.php">orders</a>
							<a href="signout.php">signout</a>
						</div>
				</div>
			<?php }else{?>
				<li><a href="login.php">Sign In</a></li>
				<li><a href="signup.php">Sign Up</a></li>
			<?php }?>
			<li><a href="shop.php">Shop</a></li>
			<li><a href="aboutus.php">About Us</a></li>
			<li><a href="index.php">Home</a></li>
		</ul>
	</nav>
</html>