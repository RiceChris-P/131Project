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
			<li><a href="login.php">Sign In</a></li>
			<li><a href="navbar.html">Sign Up</a></li>
			<li><a href="shop.php">Shop</a></li>
			<li><a href="aboutus.html">About Us</a></li>
			<li><a href="index.html">Home</a></li>
		</ul>
		<div class="cartPreview">
			<button class="cartPreviewButton">
				<img class="cartImage" src="assets/cart.png" alt=""> 
				<p class="cartPreviewText">$0.00</p>
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
				<img src="itemImages/<?php echo $rows['Image'];?>" alt="banana" class="productImage"> 
				<p class="itemName"><?php echo $rows['Name'];?></p> 
				<p class="itemPrice">Price: $<?php echo $rows['Price'];?> / ea</p>
				<button class="cartButton">Add to cart</button>
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

</html>

