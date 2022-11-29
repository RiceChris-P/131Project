<?php
session_start();

//get cart from post parameters
$_POST = json_decode(file_get_contents("php://input"), true);
$cart = json_encode($_POST);

//if signed in, save cart to db. else save cart to session
if(isSet($_SESSION['login'])){
	//set id var
	$ID = $_SESSION['login'];
	// Connect to local database
	$conn = mysqli_connect("localhost","root", "","cmpe131");
	// Checking for connections
	if (!$conn) {die("Connection failed: " . mysqli_connect_error());}
	 //create prepared query
	$query = "UPDATE accounts SET cart=? WHERE email=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("ss", $cart, $ID);
	$stmt->execute();
	$_SESSION["cart"] = $cart;
	echo $_SESSION["cart"];
} else {
	$_SESSION["cart"] = $cart;
	echo $_SESSION["cart"];
}
?>