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
<!DOCTYPE html>
<html>
	<style>
		body {
			background-image: url("assets/background.jpg");
		}
	</style>
	<head>
		<link rel="stylesheet" href="style/index.css">
		<link rel="stylesheet" href="style/navbar.css">
		<link rel="stylesheet" href="style/cart.css">

		
	</head>
	<div class="navBar">
		<ul>
			<div class="navLeft">
				<div class="navElement">
					<a href="index.php"><img class="navLogo" src="assets/logo-transparent.png" alt=""></a>
				</div>
			</div>

			<div class="navRight">
				<div class="navElement">
					<button class="navElementButton" onclick="location.href = 'index.php';">Home</button>
				</div>

				<div class="navElement">
					<button class="navElementButton" onclick="location.href = 'pages/aboutus.php';">About Us</button>
				</div>

				<div class="navElement">
					<button class="navElementButton" onclick="location.href = 'pages/shop.php';">Shop</button>
				</div class="navElement">

				<?php if($num==true && $temp != null){$fname = $temp["fname"];	?>
					<div class="navElement">
						<div class="dropdown">
							<button class="dropdownbtn"><img src="assets/accounticon.png" alt="" class="accountIconIMG" onclick="dropDown()"></button>
							
						</div>
					</div>
				<?php }else{?>
					<div class="navElement">
						<button class="navElementButton" onclick="location.href = 'pages/login.php';">Sign In</button>
					</div>

					<div class="navElement">
						<button class="navElementButton" onclick="location.href = 'pages/signup.php';">Sign Up</button>
					</div>
				<?php }?>	
				
				<div class="navElement">
					<button class="cartPreviewButton" onclick="showCart()">
						<img class="cartPreviewImage" src="assets/cart.png" alt=""> 
					</button>
				</div>
			</div>
		</ul>
	</div>

	<div class="dropdownmenu" id="dropdownmenu" style="visibility: hidden">
		<p><?php echo $fname ?></p>
		<a href="pages/account.php">Account</a>
		<a href="pages/orders.php">Orders</a>
		<a href="pages/signout.php">Signout</a>
	</div>
	
	<!--Body for cart-->
	<div class="cart" id="cart" style="visibility: hidden">
		<div id="cartHeader">
			<div id="cartHeaderProduct">Product</div>
			<div id="cartHeaderTotal">Total</div>
		</div>

		<div id="items">
			<div class="cartItemContainer" id="cartItemContainer">
			</div>
		</div>
	
		<div class="cartTotal">
			<p class="cartTotalText">Total:</p>
			<p class="cartTotalText" id="cartTotalText" >$0.00</p>
			<button id="checkoutbtn" class="checkoutbtn" onclick="checkOut()">
					Checkout
			</button>
		</div>
	</div>

	<body class="homeBody">
		<h1 class="landingHeader">OFS</h1>
		
		<br>
		
		<h3 class="description">Shopping at the store is stressful, annoying, and a waste of time! Instead</h3>
		<h3 class="description"> of grocery shopping, you can start working your nine to five job, spending  </h3>
		<h3 class="description"> time with your family, or even start a career as a full-time couch potato!</h3>
		
		<h3 class="description"> OFS will take care of your weekly groceries so you can take care of yourself!</h3>
		
		<br><br><br>

		<button class="landingShopButton"><a href="pages/shop.php">SHOP NOW</button>
    </body>

	<script src="pages/script/cart.js"></script>
</html>

