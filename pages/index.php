<?php
include("navbar.php");
?>
<html>

    <head>
        <title>Home Page</title>
        <link rel="stylesheet" href="../style/index.css">

		
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
		.landingHeader{
			font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
			color: #04BF55;
            font-size: 10rem;
			margin-top: 0%;
			margin-left: 2%;
            -webkit-text-stroke-width: 4px;
            -webkit-text-stroke-color: #1704aa;	
			text-shadow: 0 0 15px #000;		
			margin-bottom: 0%;

		}

		.description{
			font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
			color: #1704aa;
			font-weight: lighter;
            font-size: 1rem;
			line-height: 1;
			margin-left: 2%;
			margin-top:0%;
			
		}
		.wrap {
			height: 100%;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.landingShopButton {
			width: 500px;
			height: 55px;
			font-family: 'Roboto', sans-serif;
			font-size: 15px;
			text-transform: uppercase;
			letter-spacing: 2.5px;
			font-weight: 500;
			color: #000;
			background-color: #04BF55;
			border: none;
			border-radius: 45px;
			box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
			transition: all 0.3s ease 0s;
			cursor: pointer;
			outline: none;
			margin-left: 2%;
			}

		.landingShopButton:hover {
			background-color: #2EE59D;
			box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
			color: #fff;
			transform: translateY(-7px);
		}

		a:link {color: white; text-decoration: none;}


		a:visited { text-decoration: none; }


		a:hover { text-decoration: none; }


		a:active { text-decoration: none; }
	</style>
	
    <body>
	<h1 class="landingHeader">OFS</h1>
	<br>
	<h3 class="description">Shopping at the store is stressful, annoying, and a waste of time! Instead</h3>
	<h3 class="description"> of grocery shopping, you can start working your nine to five job, spending  </h3>
	<h3 class="description"> time with your family, or even start a career as a full-time couch potato!</h3>
	<h3 class="description"> OFS will take care of your weekly groceries so you can take care of yourself!</h3>
	<br><br><br>
	<button class="landingShopButton"><a href="..\pages\shop.php">SHOP NOW</button>
    </body>
    
</html>
