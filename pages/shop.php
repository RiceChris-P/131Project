<?php
//include navbar
include("navbar.php");

//Connect to local database
$conn = mysqli_connect("localhost","root", "","cmpe131");

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
	<head>
		<title>Shop</title>
		<link rel="stylesheet" href="../style/shopstyle.css">
	</head>

	<!--Body for shop more items-->
	<body class="shopBody">
	<h1 id="shopMoreTitle">Categories</h1>
		<div class="wrapper">
			<div id="shopMoreContainer">
				<a href="dairy.php">
					<div class="shopMore">
						<img src="../aisleImages/dairy.png" class="aisleImage">
						<br>
						<button class="aisleButton">Dairy</button>
					</div>
				</a>
				<a href="fruit.php">
					<div class="shopMore">
						<img src="../aisleImages/fruit.png" class="aisleImage">
						<br>
						<button class="aisleButton">Fruits</button>
					</div>
				</a>
				<a href="vegetable.php">
					<div class="shopMore">
						<img src="../aisleImages/produce.png" class="aisleImage">
						<br>
						<button class="aisleButton">Vegetables</button>
					</div>
				</a>
				<a href="meat.php">
					<div class="shopMore">
						<img src="../aisleImages/meat.png" class="aisleImage">
						<br>
						<button class="aisleButton">Meat</button>
					</div>
				</a>
				<a href="seafood.php">
					<div class="shopMore">
						<img src="../aisleImages/seafood.png" class="aisleImage">
						<br>
						<button class="aisleButton">Seafood</button>
					</div>
				</a>
			</div>
		</div>
	</body>


	<!--Body for suggested items-->
	<body class="shopBody">
	<h1 id="suggestedItemsTitle">Shop All</h1>
		<div class="wrapper">
			<div id="suggestedItemContainer">
				<?php
					//Loop through sql data to display
					while($rows=$results->fetch_assoc())
					{
						if(!$rows['Stock'] == 0) {
							$name = $rows['Name'];
				?>

				<div class="suggestedItem">
					<!--Displays each item from database-->
					<img src="../itemImages/<?php echo $rows['Image'];?>" class="productImage">
					<p class="itemName"><?php echo $rows['Name'];?></p>
					<p class="itemPrice">Price: $<?php echo number_format($rows['Price'], 2, ".", ",");?> / ea</p>
					<button class="cartButton" onclick='addToCart(<?php echo json_encode($name);?>)'>Add to cart</button>
					</div>

				<?php
						}
					}
				?>
			</div>
		</div>
	</body>

	
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

		<div id="checkout" class="checkout">
				<button id="checkoutbtn" class="checkoutbtn" onclick="checkOut()">
					Checkout
				</button>
		</div>
	</div>

	<style>
		a:link {color: black; text-align: center; font-family: Arial, Helvetica, sans-serif;}
	</style>
</html>
