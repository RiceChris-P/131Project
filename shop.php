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
	<link rel="stylesheet" href="shopstyle.css">
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
		<div class="cartPreview">
			<button class="cartPreviewButton" onclick="showCart()">
				<img class="cartPreviewImage" src="assets/cart.png" alt="">
				<p class="cartPreviewText" id="cartPreviewText" >$0.00</p>
			</button>
		</div>
	</div>
	<!--Body for suggested items-->
	<body class="shopBody">
		<h1 id="suggestedItemsTitle">Fresh This Season</h1>
		<div id="suggestedItemContainer">
			<?php
				//Loop through sql data to display
				while($rows=$results->fetch_assoc())
				{
			?>

			<div class="suggestedItem">
				<!--Displays each item from database-->
				<img src="itemImages/<?php echo $rows['Image'];?>" class="productImage">
				<p class="itemName"><?php echo $rows['Name'];?></p>
				<p class="itemPrice">Price: $<?php echo number_format($rows['Price'], 2, ".", ",");?> / ea</p>
				<button class="cartButton" onclick="addToCart(<?php echo $rows['Price'];?>)">Add to cart</button>
			</div>

			<?php
				}
			?>
		</div>
	</body>

	<!--Body for shop more items-->
	<body class="shopBody">
		<h1 id="suggestedItemsTitle">Shop More</h1>
		<div id="suggestedItemContainer">
		</div>
	</body>

	<div class="cart" id="cart" style="visibility: hidden">
		<div id="cartHeader">
			<div id="cartHeaderProduct">Product</div>
			<div id="cartHeaderTotal">Total</div>
		</div>
		<div class="cartItemContainer">
			<img src="itemImages/avocado.png" class="cartImage">
			<div class="cartProduct">
				<p style="margin-bottom:0; margin-top: 40%;">Avocado</p>
				<p style="margin-top:0; font-size:14px;">$2.50 / ea</p>
			</div>
			<div class="rightCartContainer">
				<p class="cartPrice" style="margin-bottom: 0">$2.50</p>
				<div class="addsubButton">
					<button class="addButton">-</button>
					<input class="amountField" id="test" type="text" min="1" max="99" value="1">
					<button class="subButton" onclick="increment()">+</button>
				</div>
				<button class="removeCart" onclick="removeFromCart()">Remove</button>
			</div>
		</div>

	</div>


	<script>
		let total = 0.00;
		function addToCart(price) {
			total += price;
			document.getElementById("cartPreviewText").innerHTML = "$"+total.toFixed(2);
			if (cart.style.visibility === "hidden") {
				cart.style.visibility = "visible";
			}
		}
		function showCart() {
			var cart = document.getElementById("cart");
			if (cart.style.visibility === "hidden") {
				cart.style.visibility = "visible";
			} else {
				cart.style.visibility = "hidden";
			}
		}
		function removeFromCart(){

		}
		function increment(){

		}
		function decrement(){

		}

	</script>

</html>
