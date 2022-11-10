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

	<!--Body for suggested items-->
	<body class="shopBody">
		<h1 id="suggestedItemsTitle">Fresh This Season</h1>
		<div id="suggestedItemContainer">
			<?php
				//Loop through sql data to display
				while($rows=$results->fetch_assoc())
				{
					$name = $rows['Name']
			?>

			<div class="suggestedItem"> 
				<!--Displays each item from database-->
				<img src="../itemImages/<?php echo $rows['Image'];?>" class="productImage">
				<p class="itemName"><?php echo $rows['Name'];?></p> 
				<p class="itemPrice">Price: $<?php echo number_format($rows['Price'], 2, ".", ",");?> / ea</p>
				<button class="cartButton" onclick='addToCart("<?php echo $name;?>")'>Add to cart</button>
			</div>
			
			<?php
				}
			?>
		</div>
	</body>

	<!--Body for shop more items-->
	<body class="shopBody">
		<h1 id="shopMoreTitle">Shop More</h1>
		<div id="shopMoreContainer">
			<div class="shopMore"> 
				<img src="../aisleImages/produce.png" class="aisleImage">
				<br>
				<button class="aisleButton">Vegitables</button>
			</div>
			<div class="shopMore"> 
				<img src="../aisleImages/fruit.png" class="aisleImage">
				<br>
				<button class="aisleButton">Fruit</button>
			</div>
			<div class="shopMore"> 
				<img src="../aisleImages/meat.png" class="aisleImage">
				<br>
				<button class="aisleButton">Meat</button>
			</div>
			<div class="shopMore"> 
				<img src="../aisleImages/dairy.png" class="aisleImage">
				<br>
				<button class="aisleButton">Dairy</button>
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
	</div>


	<script>
		var myArr;
		var oReq = new XMLHttpRequest(); // New request object
		oReq.onload = function() {
			myArr = JSON.parse(this.responseText);
		};
		oReq.open("get", "db.php", true);
		oReq.send();

		let total = 0.00;
		function addToCart(name) {
			var product;
			myArr.forEach(item => {
				if(item.Name === name) {
					product = item;
				}
			})

			total += parseFloat(product.Price);
			document.getElementById("cartPreviewText").innerHTML = "$"+total.toFixed(2);

			var image = '<img src="../itemImages/'+product.Image+'" class="cartImage">'
			var description = '<div class="cartProduct"> <p style="margin-bottom:0; margin-top: 40%;">'+product.Name+'</p> <p style="margin-top:0; font-size:14px;">$'+product.Price+' / ea</p></div>'
			var rightSide = '<div class="rightCartContainer"><p class="cartPrice" style="margin-bottom: 0">$'+product.Price+'</p><div class="addsubButton"><button class="addButton">-</button><input class="amountField" id="test" type="text" min="1" max="99" value="1"><button class="subButton" onclick="increment()">+</button></div><button class="removeCart" onclick="removeFromCart()">Remove</button></div>'
			var element = image + description + rightSide;
			document.getElementById("items").innerHTML = document.getElementById("items").innerHTML + '<div class="cartItemContainer" id="cartItemContainer">' + element + '</div>';
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