<?php
    if (isset($_POST['submit'])) {
        $targetDir = "desktop/";
        $fileName = basename($_FILES["file"]["name"]);
        $itemName=$_POST['itemName'];
        $price=$_POST['price'];
        $weight=$_POST['weight'];
        $type=$_POST['type'];
        $targetFilePath = $targetDir . $fileName;
        $conn = mysqli_connect("localhost", "root", "", "cmpe131"); 
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql="INSERT INTO items VALUES ('$itemName','$price','$weight','".$fileName."','$type')";
        $results =mysqli_query($conn, $sql);       
    }

?>

