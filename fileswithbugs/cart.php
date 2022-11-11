<?php
//include navbar

//Connect to local database
$conn = mysqli_connect("localhost","root", "","cmpe131");

// Checking for connections
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//This gets email where the login status is true
$sql = " SELECT * FROM accounts WHERE loginStatus = 1";
$roq= mysqli_query($conn,$sql);
$rows=$roq->fetch_assoc();
$email= $rows['email'];

//This selects the rows of the email that is logged in
$sql = " SELECT * FROM cart where email='$email'";
$results= mysqli_query($conn,$sql);
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart UI</title>
    <link rel="stylesheet" type="text/css" href="../style/cartpage.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,900" rel="stylesheet">
</head>
<body>
<div class="CartContainer">
    <div class="Header">
        <h3 class="Heading">Shopping Cart</h3>
        <h5 class="Action">Remove all</h5>
    </div>
    <?php
    //Loop through sql data to display
    while($rows=$results->fetch_assoc())
    {
    ?>
    <div class="Cart-Items">
        <div class="image-box">
            <img src="../itemImages/<?php echo $rows['Image'];?>"style={{ height="80" }} />
        </div>
        <div class="about">
            <h1 class="title"><?php echo $rows['Name'];?></h1>
            <h3 class="subtitle"><?php echo $rows['Weight'];?> lb</h3>

        </div>
        <div class="counter">
            <div class="btn">-</div>
            <div class="count"><?php echo $rows['quantity'];?></div>
            <div class="btn">+</div>
        </div>
        <div class="prices">
            <div class="amount">$<?php echo number_format($rows['Price'], 2, ".", ",");?></div>
            <div class="save"><u>Save for later</u></div>
            <div class="remove"><u>Remove</u></div>
        </div>
    </div>
        <hr>

        <?php
    }
    ?>

    <div class="checkout">
        <div class="total">
            <div>
                <div class="Subtotal">Sub-Total</div>
                <div class="items">2 items</div>
            </div>
            <div class="total-amount">$6.18</div>
        </div>
        <a href="checkout.php">
        <button class="button">Checkout</button></a>

    </div>
</div>
</body>
</html>
