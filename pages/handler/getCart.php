<?php
session_start();

//if signed in, get cart from db. elseget cart from session
if(isSet($_SESSION['login'])){
	//set id var
	$ID = $_SESSION['login'];
	// Connect to local database
	$conn = mysqli_connect("localhost","root", "","cmpe131");
	// Checking for connections
	if (!$conn) {die("Connection failed: " . mysqli_connect_error());}
    //create prepared query
	$query = "SELECT cart FROM accounts WHERE email=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $ID);
	$stmt->execute();
    //get cart result
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    print_r($user['cart']);
} else {
    if(isSet($_SESSION['cart'])) {
        $cart = $_SESSION["cart"];
    } else {
        $cart = json_decode ("{}");
    }
   echo $cart;
}
?>