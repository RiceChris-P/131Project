<?php
    session_start();
	$conn = mysqli_connect("localhost","root", "","cmpe131");
	if(!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}
	$num=false;
	$temp=null;
	if(isSet($_SESSION['login'])){
		$email=$_SESSION['login'];
		$num = true;
		$sql="SELECT fname FROM accounts WHERE email='$email';";
		$results= mysqli_query($conn,$sql);
		$temp= mysqli_fetch_assoc($results);
	}
?>

<html>
	<head>
		<link rel="stylesheet" href="../style/navbar.css">
		<link rel="stylesheet" href="../style/cart.css">
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

			<?php if($num==true && $temp != null){$fname = $temp["fname"];	?>
				<div class="dropdown">
					<button class="dropdownbtn"><?php echo $fname;?></button>
						<div class="dropdownmenu">
							<a href="account.php">Account Information</a>
							<a href="orders.php">Orders</a>
							<a href="signout.php">Signout</a>
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

<style>
	a:link{color: black; font-family: Arial, Helvetica, sans-serif; text-align: center;}
	.dropdown{
		padding: 14px 16px;
		font-size: 20px;
		display: block;
		float: right;
		text-align: center;
	}
	.dropdownbtn{
		font-family: Arial, Helvetica, sans-serif;
		font-size: 20px;
		text-align: center;
	}
	.dropdownmenu a{
		font-size: 18px;
	}
</style>