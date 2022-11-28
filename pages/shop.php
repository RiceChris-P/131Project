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

	<script>
		//get stock from db
		var myArr;
		var req = new XMLHttpRequest(); //new request
		req.onload = function() {
			myArr = JSON.parse(this.responseText);
		};
		req.open("get", "handler/getStock.php", true);
		req.send();

		//global vars
		let total = 0.00;
		let cart = [];

		function addToCart(name) {
			//init product
			var product;
			//find product by name
			myArr.forEach(item => {
				if(item.Name === name) {
					product = item;
				}
			})

			//find product in cart
			var exists = false;
			cart.forEach(item => {
				//if in cart, increment
				if(item.prod.Name == product.Name) {
					item.count++;
					exists = true;
				}
			})
			//if not in cart, create new obj and add to cart
			if(!exists) {
				let temp = {prod: product, count: 1};
				cart.push(temp);
			}
			//render
			renderCart(cart);
		}

		//save cart on window exit
		window.onbeforeunload = function(){
			postCart(cart);
		}

		//restore cart on page load
		window.onload = function() {
			getCart();
		}

		//set cart to saved cart
		function setCart(obj) {
			cart = JSON.parse(obj);
			renderCart(cart);
		}

		function postCart(cart) {
			var req = new XMLHttpRequest(); //new request
			req.open("POST", "handler/postCart.php", true); //sending as POST
			req.send(JSON.stringify(cart)); //send cart
		}

		function getCart() {
			var req = new XMLHttpRequest(); //new request
			req.onload = function() {
				setCart(this.responseText); //set cart to saved cart
			};
			req.open("get", "handler/getCart.php", true); //send as GET
			req.send(); //send req
		}

		function renderCart(cart) {
			total = 0;
			document.getElementById("items").innerHTML = null;
			cart.forEach(item => {
				total += item.count * item.prod.Price;
				renderObject(item.prod, item.count);
			})
			document.getElementById("cartPreviewText").innerHTML = "$"+total.toFixed(2);

			console.log(cart);

			if(cart.length > 0) {
				document.getElementById("checkoutbtn").style.visibility = "visible";
				console.log("Cart is filled!");
			}
			else {
				document.getElementById("checkoutbtn").style.visibility = "hidden";
				console.log("Cart is empty!");
			}
		}

		function renderObject(product, count) {
			var productTotal = product.Price * count;
			productTotal = productTotal.toFixed(2)
			var image = '<img src="../itemImages/'+product.Image+'" class="cartImage">'
			var description = '<div class="cartProduct"> <p style="margin-bottom:0; margin-top: 40%;">'+product.Name+'</p> <p style="margin-top:0; font-size:14px;">$'+product.Price+' / ea</p></div>'
			var rightSide = '<div class="rightCartContainer"><p class="cartPrice" style="margin-bottom: 0">$'+productTotal+'</p><div class="addsubButton"><button class="addButton" onclick="decrement('+product.Name+')">-</button><input class="amountField" id="test" type="text" min="1" max="99" value="1"><button class="subButton" onclick="increment('+product.Name+')">+</button></div><button class="removeCart" onclick="removeFromCart('+product.Name+')">Remove</button></div>'
			var element = '<div class="cartItemContainer" id='+product.Name+'>'+image + description + rightSide+'</div>';
			document.getElementById("items").innerHTML = document.getElementById("items").innerHTML +  element;
			var cartDisplay = document.getElementById("cart");
			if (cartDisplay.style.visibility === "hidden") {
				cartDisplay.style.visibility = "visible";
			}
		}

		function showCart() {
			var length = cart.length;
			var cartDisplay = document.getElementById("cart");
			var checkout = document.getElementById("checkoutbtn");
			if (cartDisplay.style.visibility === "hidden") {
				cartDisplay.style.visibility = "visible";
			} else {
				cartDisplay.style.visibility = "hidden";
			}
			if (checkout.style.visibility === "hidden" && length > 0) {
				checkout.style.visibility = "visible";
			} else {
				checkout.style.visibility = "hidden";
			}
		}

		function removeFromCart(name){
			//get item name from html
			try{
				name = name.item(0).id;
			} catch {
				name = name.id;
			}
			//init product
			var product;
			//find product by name
			myArr.forEach(item => {
				if(item.Name === name) {
					product = item;
				}
			})

			//find in cart
			cart.forEach(item => {
				if(item.prod.Name == product.Name) {
					//remove
					cart.pop(item);
				}
			})
			//render
			renderCart(cart);
		}

		function increment(name){
			//get name from html
			try{
				name = name.item(0).id;
			} catch {
				name = name.id;
			}
			//init product
			var product;
			myArr.forEach(item => {
				if(item.Name === name) {
					product = item;
				}
			})

			//find in cart
			cart.forEach(item => {
				if(item.prod.Name == product.Name) {
					//increment
					item.count++;
				}
			})
			//render
			renderCart(cart);
		}

		function decrement(name){
			try{
				nameID = name.item(0).id;
			} catch {
				nameID = name.id;
			}
			//init product
			var product;
			myArr.forEach(item => {
				if(item.Name === nameID) {
					product = item;
				}
			})

			//find in cart
			cart.forEach(item => {
				if(item.prod.Name == product.Name) {
					//decrement
					item.count--;
					//if count is now 0, remove
					if(item.count == 0) {
						cart.pop(item);
					}
				}
			})
			//render
			renderCart(cart);
		}

		function checkOut() {
			location.href = "checkout.php";
		}
	</script>

	<style>
		a:link {color: black; text-align: center; font-family: Arial, Helvetica, sans-serif;}
	</style>
</html>
