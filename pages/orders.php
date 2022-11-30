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
$query = "SELECT * FROM orders WHERE email=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $ID);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
    <h1>Orders</h1>
    <?php
        while($order = $result->fetch_assoc()) {
    ?>
         <div class="order">
            <p>Order: #<?php print_r($order['ordernum']);?></p>
            <p>Items: <?php print_r($order['items']);?></p>
            <p>Price: $<?php print_r($order['costofitems']);?></p>
            <p>Weight: <?php print_r($order['totalweight']);?> lbs</p>
            <p>Fee: $<?php print_r($order['weightfee']);?></p>
            <p>Total: <?php print_r($order['totalcost']);?></p>
            <p>Contact: <?php print_r($order['contactinfo']);?></p>
            <p>Delivery: <?php print_r($order['deliveryinfo']);?></p>
            <p>Payment: <?php print_r($order['paymentinfo']);?></p>
        </div>
    <?php
        }
    ?>
</html>