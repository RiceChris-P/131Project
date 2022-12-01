<?php
    if (isset($_POST['submit'])) {
        $oName=$_POST['oldItemName'];
        $itemName=$_POST['itemName'];
        $price=$_POST['price'];
        $weight=$_POST['weight'];
        $type=$_POST['itemType'];
        $inventory=$_POST['numOfItems'];
        if(isset($_POST['file'])){
            $targetDir = "../itemImages";
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = "$targetDir/$fileName";
            $conn = mysqli_connect("localhost", "root", "", "cmpe131");
            if(!$conn){
                die("Connection failed: " . mysqli_connect_error());
            }
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                $sql="UPDATE items Name='$itemName' Price='$price' Weight='$weight'
                Type='$type' Stock='$inventory' Image='".$fileName."' WHERE Name='$oName'";
                mysqli_query($conn, $sql);
            }
        }
        else{
            $sql="UPDATE items Name='$itemName' Price='$price' Weight='$weight'
                Type='$type' Stock='$inventory' WHERE Name='$oName'";
            mysqli_query($conn,$sql);
        }
    }
?>

