<?php
//Connect to local database
$conn = mysqli_connect("localhost","root", "","stock");
// Checking for connections
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// SQL query to select data from database
$sql = " SELECT * FROM items";
$results= mysqli_query($conn,$sql);
$conn->close();
?>

<!DOCTYPE html>
<html>
	<link rel="stylesheet" href="navstyle.css">
	<!--Site Header-->
	<div class="header">
		<ul>
      <img class="logo" src="assets/logo-transparent.png" alt="">
		  <li><a href="cart.php">Cart</a></li>
			<li><a href="login.php">Sign In</a></li>
			<li><a href="signup.php">Sign Up</a></li>
			<li><a href="shop.php">Shop</a></li>
			<li><a href="aboutus.html">About Us</a></li>
			<li><a href="index.html">Home</a></li>
    </ul>

    <link rel="stylesheet" href="cart.css">
      <body>
       <div class=”Cart-Container”></div>
      </body>
      <body>
     <div class=”Cart-Container”></div>
    </body>

    <div class=”Header”>
     <h3 class=”Heading”>Shopping Cart</h3>
     <h5 class=”Action”>Remove all</h5>
     </div>

    <div class=”Cart-Items”>
     <div class=”image-box”>
     <img src=”images/apple.png” style={{ height=”120px” }} />
     </div>
     <div class=”about”>
     <h1 class=”title”>Apple Juice</h1>
     <h3 class=”subtitle”>250ml</h3>
     <img src=”images/veg.png” style={{ height=”30px” }}/>
     </div>
     <div class=”counter”></div>
     <div class=”prices”></div>
     </div>

    <div class=”counter”>
     <div class=”btn”>+</div>
     <div class=”count”>2</div>
     <div class=”btn”>-</div>
     </div>


    <div class=”prices”>
     <div class=”amount”>$2.99</div>
     <div class=”save”><u>Save for later</u></div>
     <div class=”remove”><u>Remove</u></div>
     </div>

    <hr>
     <div class=”checkout”>
     <div class=”total”>
     <div>
     <div class=”Subtotal”>Sub-Total</div>
     <div class=”items”>2 items</div>
     </div>
     <div class=”total-amount”>$6.18</div>
     </div>
     <button class=”button”>Checkout</button>
     </div>

</html>
