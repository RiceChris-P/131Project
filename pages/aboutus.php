<?php
	include("navbar.php");
?>
<html>
  
	<head>
    <title>About Us</title>
		<link rel="stylesheet" type="text/css" href="../style/aboutus.css">
		<link rel="stylesheet" type="text/css" href="../style/navbar.css">
		<link rel="stylesheet" type="text/css" href="../style/cart.css">
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
	<style>
		.abth{
			font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
			text-align: center;
			padding-top: 2%;
			font-size: 275%;
		}
		.abtDevs{
			font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
			font-size: 190%;
			text-align: center;
			margin: auto;
		}
		.abtText{
			font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
			font-size: 150%;
			text-align: center;
		}
	</style>
     <body>
	 	<h1 class="abth"><b>Developers</b></h1>
		<br>
		<h1 class="abtDevs">Kevin Boc</b1>
		<br>
		<h1 class="abtDevs">Jordan Fung</b1>
		<br>
		<h1 class="abtDevs">Zachary Menes</b1>
		<br>
		<h1 class="abtDevs">Sharanya Udupa</b1>
		<br>
		<h1 class="abtDevs">Cameron Harris</b1>
		<br>
		<h1 class="abtDevs">Jose Monroy Villalobos</b1>
		<br>
		<h1 class="abtDevs">Christopher Park</b1>
		<br>
		<br>
		<br>
		<br>
		<h1 class="abtText">This webpage is an online sales platform created for a downtown San Jose grocery</b1>
		<h1 class="abtText">store that wanted to implement a delivery service. Created by an interdisciplinary</b1>
		<h1 class="abtText">team of engineers at San Jose State University, everything from the webpage itself</b1>
		<h1 class="abtText">to the databases used to track customer accounts, carts, and the items being sold</b1>
		<h1 class="abtText">by the retailer was made from scratch.</b1>
     </body>

</html>


