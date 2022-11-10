<?php
//This can be used to make an api call in javascript and get a JSON of the database

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

$arr = array();
while($rows=$results->fetch_assoc()) {
    array_push($arr, $rows);
}
echo json_encode($arr);

?>