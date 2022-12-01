<?php 
include("navbar.php");

$ID = $_SESSION['login'];
//Connect to local database
$conn = mysqli_connect("localhost","root", "","cmpe131");
// Checking for connections
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
// SQL query to select data from database
$query = "SELECT * FROM orders WHERE email=? ORDER BY orderdate DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $ID);
$stmt->execute();
$result = $stmt->get_result();

function itemDisplay($name, $price, $weight, $image, $quantity) {
    echo <<<HTML
        <div class="items">
                <p>
                    Item: $name <br>
                    Quantity: $quantity <br>
                    Price: $$price <br>
                    Weight: $weight lbs<br>
                </p>
        </div>
    HTML;
}

function contactDisplay($fname, $lname, $email, $phone) {
    echo <<<HTML
        <div class="">
            <div class="">
                <p>
                    Name: $fname $lname<br>
                    Email: $email<br>
                    Phone: $phone<br>
                </p>
            </div>
        </div>
    HTML;
}

function deliveryDisplay($address, $aptsuiteetc, $state, $city, $zip) {
    echo <<<HTML
        <div class="">
            <div class="">
                <p>
                    Address: $address<br>
                    Apt/Suite: $aptsuiteetc<br>
                    State: $state<br>
                    City: $city <br>
                    ZIP: $zip <br>
                </p>
            </div>
        </div>
    HTML;
}

function paymentDisplay($cardname, $cardnumber, $cardexpdate, $cardcvv) {
    echo <<<HTML
        <div class="">
            <div class="">
                <p>
                    Name: $cardname<br>
                    Number: $cardnumber<br>
                    Expiration: $cardexpdate<br>
                    CVV: $cardcvv <br>
                </p>
            </div>
        </div>
    HTML;
}


?>
<!DOCTYPE html>
<html>
    <head>
        <Title>Orders</Title>
        <link rel="stylesheet" href="../style/orders.css">
    </head>
    <body>
    <h1>Orders</h1>
        <?php
            while($order = $result->fetch_assoc()) {
        ?>
            <div class="order">
                <h2><p> Order: #<?php print_r($order['ordernum']);?></p></h2>
                <p> <h3>Date:</h3><?php print_r($order['orderdate']);?></p>
                <p> <h3>Items: </h3> 
                    <div class="itemContainer">
                        <?php 
                            $items = json_decode($order['items'], true);   
                            $size = count($items);
                            for ($x = 0; $x < $size; $x++) {
                                $temp = $items[$x];
                                $prod = $temp['prod'];
                                $count = $temp['count'];
                                itemDisplay($prod['Name'], $prod['Price'], $prod['Weight'], $prod['Image'], $count);
                            }
                        ?>
                    </div>
                </p>
                <p><h3>Price:</h3> $<?php print_r($order['subtotal']);?></p>
                <p><h3>Weight:</h3><?php print_r($order['totalweight']);?> lbs</p>
                <p><h3>Fee:</h3>$<?php print_r($order['weightfee']);?></p>
                <p><h3>Total:</h3>$<?php print_r($order['totalcost']);?></p>
                <p><h3>Contact:</h3>
                    <?php 
                        $temp = json_decode($order['contactinfo'], true);
                        contactDisplay($temp['firstName'], $temp['lastName'], $temp['email'], $temp['phone'])
                    ?>
                </p>
                <p><h3>Delivery:</h3>
                    <?php 
                        $temp = json_decode($order['deliveryinfo'], true);
                        deliveryDisplay($temp['address'], $temp['aptsuiteect'], $temp['state'], $temp['city'], $temp['zip'])
                    ?>
                </p>
                <p><h3>Payment:</h3>
                    <?php 
                       $temp = json_decode($order['paymentinfo'], true);
                       paymentDisplay($temp['cardname'], $temp['cardnumber'], $temp['cardexpdate'], $temp['cardcvv'])
                    ?>
                </p>
            </div>
        <?php
            }
        ?>
    </body>
</html>