<?php
    if (isset($_POST['submit'])) {
        $targetDir = "../itemImages";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = "$targetDir/$fileName";
        $itemName=$_POST['itemName'];
        $price=$_POST['price'];
        $weight=$_POST['weight'];
        $type=$_POST['itemType'];
        $inventory=$_POST['numOfItems'];
        $conn = mysqli_connect("localhost", "root", "", "cmpe131");
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            $sql="INSERT INTO items VALUES ('$itemName','$price','$weight','".$fileName."','$type','$inventory')";
            mysqli_query($conn, $sql);
        }
        else{
            echo "error";
        }
    }
?>

