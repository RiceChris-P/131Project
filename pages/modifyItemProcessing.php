<?php
//0 is false
//1 is true
    $success=0;
    if (isset($_POST['submit'])) {
        $conn = mysqli_connect("localhost", "root", "", "cmpe131");
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        $oName=$_POST['oldItemName'];
        $itemName=$_POST['itemName'];
        $price=$_POST['price'];
        $weight=$_POST['weight'];
        $type=$_POST['itemType'];
        $inventory=$_POST['numOfItems'];
        $len=$_FILES["file"]["name"];
        if(strlen($len>3)){
            $targetDir = "../itemImages";
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = "$targetDir/$fileName";
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                $sql="UPDATE items SET Name='$itemName', Price='$price', Weight='$weight',
                Type='$type', Stock='$inventory', Image='".$fileName."' WHERE Name='$oName'";
                mysqli_query($conn, $sql);
                $success=1;
            }
        }
        else{
            $sql="UPDATE items SET Name='$itemName', Price='$price', Weight='$weight',
                Type='$type', Stock='$inventory' WHERE Name='$oName'";
            mysqli_query($conn,$sql);
            $success=1;
        }
    }
    else if(isset($_POST['delete'])){
        $oName=$_POST['oldItemName'];
        $conn = mysqli_connect("localhost", "root", "", "cmpe131");
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql="DELETE FROM items where Name='$oName'";
        mysqli_query($conn,$sql);
        $success=1;
    }
?>
<html>
    <body onload="document.forms[0].submit()">
    <form method="post" action="modifyItemInDatabase.php">
        <input type="text" name="status" id=0 value="<?php echo $success?>"></input>
    </form>
</body>
</html>


