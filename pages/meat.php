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
<html>
    <head>
        <title>Meat</title>
        <link rel="stylesheet" href="../style/category.css">
    </head>

    <!--Body for suggested items-->
	<body class="shopBody">
		<h1 id="itemsTitle">Meat</h1>
		<div id="itemContainer">
			<?php
				//Loop through sql data to display
				while($rows=$results->fetch_assoc())
				{
                    $type = strcmp(strtolower($rows['Type']), "meat");
					if($type == 0) {
                        $name = $rows['Name'];
                        $img = $rows['Image'];
                        $price = $rows['Price'];
			?>

			<div class="item">
				<!--Displays each item from database-->
				<img src="../itemImages/<?php echo $img;?>" class="productImage">
				<p class="itemName"><?php echo $name;?></p>
				<p class="itemPrice">Price: $<?php echo number_format($price, 2, ".", ",");?> / ea</p>
				<button class="cartButton" onclick='addToCart("<?php echo $name;?>")'>Add to cart</button>
			</div>

			<?php
				}
            }
			?>
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
</html>