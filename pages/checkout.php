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

            <?php if(isset($_SESSION['login']) && $_SESSION['login'] == true) { ?>
                <form action="">
                    
                    <input type="text" name="address" class="" placeholder="Street Address"><br>
                    <input type="text" name="aptsuiteunit" class="" placeholder="Apt, suite, rtc. (optional)"><br>
                    <input type="text" name="city" class="" placeholder="City"><br>
                    <input type="text" name="state" class="" placeholder="State"><br>
                    <input type="text" name="zip" class="" placeholder="ZIP"><br>

                </form>
            <?php } 
            else { ?>
                <input type="text" name="firstName" class="" placeholder="First Name"><br>
                <input type="text" name="lastName" class="" placeholder="Last Name"><br>
                <input type="text" name="phone" class="" placeholder="Phone Number"><br>
                <input type="text" name="email" class="" placeholder="Email Address"><br>
                <input type="text" name="address" class="" placeholder="Street Address"><br>
                <input type="text" name="aptsuiteunit" class="" placeholder="Apt, suite, rtc. (optional)"><br>
                <input type="text" name="city" class="" placeholder="City"><br>
                <input type="text" name="state" class="" placeholder="State"><br>
                <input type="text" name="zip" class="" placeholder="ZIP"><br>
            <?php } ?> 

            <!-- <button type="button" onclick="showCheckOut()">Guest Checkout</button> -->

        </div>
    </body>
</html>