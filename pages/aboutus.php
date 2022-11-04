<?php
	include("navbar.php");
?>
<html>
  
	<head>
    <title>About Us</title>
		<link rel="stylesheet" href="../style/aboutus.css">
		<link rel="stylesheet" href="../style/navbar.css">
		<link rel="stylesheet" href="../style/cart.css">
	</head>

	<div class="cart" id="cart" style="visibility: hidden">
		<div id="cartHeader">
			<div id="cartHeaderProduct">Product</div>
			<div id="cartHeaderTotal">Total</div>
		</div>
		<div class="cartItemContainer">
			<img src="../itemImages/avocado.png" class="cartImage">
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

  <body class="staticBody">
  </body>

</html>


