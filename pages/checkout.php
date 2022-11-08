<!DOCTYPE html>

<?php
    session_start();
    include("navbar.php");
    $conn = mysqli_connect("localhost", "root", "", "cmpe131");
?>

<html>

    <head>
        <title>Check Out</title>
        <link rel="stylesheet" href="../style/checkout.css">
    </head>

    <body>
        <div>
            <div class="checkOutInfo">
                <?php if(isset($_SESSION['login']) && $_SESSION['login'] == true) { ?>
                    <p>Dev Note: Logged Out</p>
                    <h1>Contact Information</h1>
                    <form action="">
                        
                        <input type="text" name="address" class="" placeholder="Street Address"><br>
                        <input type="text" name="aptsuiteunit" class="" placeholder="Apt, suite, rtc. (optional)"><br>
                        <input type="text" name="city" class="" placeholder="City"><br>
                        <input type="text" name="state" class="" placeholder="State"><br>
                        <input type="text" name="zip" class="" placeholder="ZIP"><br>

                    </form>
                <?php } else { ?>
                    <form action="">
                        <p>Dev Note: Logged Out</p>
                        <h2>Contact Information</h2>

                        <input type="text" name="firstName" class="" placeholder="First Name">
                        <input type="text" name="lastName" class="" placeholder="Last Name"><br>
                        <input type="text" name="email" class="" placeholder="Email Address"><br>
                        <input type="text" name="phone" class="" placeholder="Phone Number">

                        <h2>Delivery Information</h2>
                        <input type="text" name="address" class="" placeholder="Street Address"><br>
                        <input type="text" name="aptsuiteunit" class="" placeholder="Apt, suite, etc. (optional)"><br>
                        <input type="text" name="state" class="" placeholder="State">
                        <input type="text" name="city" class="" placeholder="City">
                        <input type="text" name="zip" class="" placeholder="ZIP"><br>
                        
                        <h2>Payment Information</h2>
                        <input type="text" name="cardname" placeholder="Name On Card"><br>
                        <input type="text" name="cardnumber" placeholder="Card Number">
                        <input type="text" name="cardexpiration" placeholder="Exp MM/YY">
                        <input type="text" name="cardcvv" placeholder="Enter CVV"><br>
                        <button type="submit" name="checkoutsubmit">Submit Payment</button>
                    </form>
                <?php } ?> 
            </div>

            <div class="cartInCheckOut">
                <h2>Cart</h2>
            </div>
        </div>
    </body>
</html>