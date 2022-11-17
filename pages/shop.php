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

			//check if product is in cart
			let object = cart.find(x => x.prod === product)
			if(object) {
				//product in cart, incremenet count and rerender total for item
				let index = cart.indexOf(object);
				cart.fill(object.count=object.count + 1, index, index++);
				modifyProd(product, object.count);
			} else {
				//product not in cart, add to cart and render
				let temp = {prod: product, count: 1};
				cart.push(temp);
				renderNewProd(product);
			}
			console.log(cart);
		}

		function renderNewProd(product) {
			total += parseFloat(product.Price);
			document.getElementById("cartPreviewText").innerHTML = "$"+total.toFixed(2);

			var image = '<img src="../itemImages/'+product.Image+'" class="cartImage">'
			var description = '<div class="cartProduct"> <p style="margin-bottom:0; margin-top: 40%;">'+product.Name+'</p> <p style="margin-top:0; font-size:14px;">$'+product.Price+' / ea</p></div>'
			var rightSide = '<div class="rightCartContainer"><p class="cartPrice" style="margin-bottom: 0">$'+product.Price+'</p><div class="addsubButton"><button class="addButton" onclick="decrement('+product.Name+')">-</button><input class="amountField" id="test" type="text" min="1" max="99" value="1"><button class="subButton" onclick="increment('+product.Name+')">+</button></div><button class="removeCart" onclick="removeFromCart('+product.Name+')">Remove</button></div>'
			var element = '<div class="cartItemContainer" id='+product.Name+'>'+image + description + rightSide+'</div>';
			document.getElementById("items").innerHTML = document.getElementById("items").innerHTML +  element;
			var cart = document.getElementById("cart");
			if (cart.style.visibility === "hidden") {
				cart.style.visibility = "visible";
			}

		}

		function modifyProd(product, count) {
			total += parseFloat(product.Price);
			document.getElementById("cartPreviewText").innerHTML = "$"+total.toFixed(2);

			let productTotal = product.Price * count;
			var image = '<img src="../itemImages/'+product.Image+'" class="cartImage">'
			var description = '<div class="cartProduct"> <p style="margin-bottom:0; margin-top: 40%;">'+product.Name+'</p> <p style="margin-top:0; font-size:14px;">$'+product.Price+' / ea</p></div>'
			var rightSide = '<div class="rightCartContainer"><p class="cartPrice" style="margin-bottom: 0">$'+productTotal.toFixed(2)+'</p><div class="addsubButton"><button class="addButton" onclick="decrement('+product.Name+')">-</button><input class="amountField" id="test" type="text" min="1" max="99" value="1"><button class="subButton" onclick="increment('+product.Name+')">+</button></div><button class="removeCart" onclick="removeFromCart('+product.Name+')">Remove</button></div>'
			var element = '<div class="cartItemContainer" id='+product.Name+'>'+image + description + rightSide+'</div>';
			document.getElementById(product.Name).innerHTML = element;
			var cart = document.getElementById("cart");
			if (cart.style.visibility === "hidden") {
				cart.style.visibility = "visible";
			} 
		}

		function decrementProd(product, count) {
			total -= parseFloat(product.Price);
			document.getElementById("cartPreviewText").innerHTML = "$"+total.toFixed(2);

			let productTotal = product.Price * count;
			var image = '<img src="../itemImages/'+product.Image+'" class="cartImage">'
			var description = '<div class="cartProduct"> <p style="margin-bottom:0; margin-top: 40%;">'+product.Name+'</p> <p style="margin-top:0; font-size:14px;">$'+product.Price+' / ea</p></div>'
			var rightSide = '<div class="rightCartContainer"><p class="cartPrice" style="margin-bottom: 0">$'+productTotal.toFixed(2)+'</p><div class="addsubButton"><button class="addButton" onclick="decrement('+product.Name+')">-</button><input class="amountField" id="test" type="text" min="1" max="99" value="1"><button class="subButton" onclick="increment('+product.Name+')">+</button></div><button class="removeCart" onclick="removeFromCart('+product.Name+')">Remove</button></div>'
			var element = '<div class="cartItemContainer" id='+product.Name+'>'+image + description + rightSide+'</div>';
			document.getElementById(product.Name).innerHTML = element;
			var cart = document.getElementById("cart");
			if (cart.style.visibility === "hidden") {
				cart.style.visibility = "visible";
			} 
		}

		function removeProd(product, count) {
			total -= parseFloat(product.Price * count);
			document.getElementById("cartPreviewText").innerHTML = "$"+total.toFixed(2);
			
			document.getElementById(product.Name).innerHTML = null;
			
		}


		function showCart() {
			var cart = document.getElementById("cart");
			if (cart.style.visibility === "hidden") {
				cart.style.visibility = "visible";
			} else {
				cart.style.visibility = "hidden";
			}
		}

		function removeFromCart(name){
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
			//find product in cart
			let object = cart.find(x => x.prod === product)
			if(object) {
				cart.pop(object);
				removeProd(product, object.count);
			}
			//console.log(cart);
		}

		function increment(name){
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
			let object = cart.find(x => x.prod === product)
			object.count++;
			modifyProd(product, object.count);
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
			let object = cart.find(x => x.prod === product)
			object.count--;
			if(object.count == 0) {
				removeFromCart(name);
			}
			decrementProd(product, object.count);
		}

	</script> 

</html>