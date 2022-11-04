<!DOCTYPE html>
<html>
  
  <head>
    <title>About Us</title>
    <link rel="stylesheet" href="../style/aboutus.css">
    <link rel="stylesheet" href="../style/navbar.css">
    <link rel="stylesheet" href="../style/cart.css">
  </head>

  <nav class="navBar">
    <ul>
        <a href="index.php"><img class="navLogo" src="../assets/logo-transparent.png" alt=""></a>
        <li class="cartPreview">	
					<button class="cartPreviewButton" onclick="showCart()">
						<img class="cartPreviewImage" src="../assets/cart.png" alt=""> 
						<p class="cartPreviewText" id="cartPreviewText" >$0.00</p>
					</button>
				</li>
        <li><a href="login.php">Sign In</a></li>
        <li><a href="signup.php">Sign Up</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="index.php">Home</a></li>
    </ul>
</nav>

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


