<?php
    session_start();
    $_SESSION["login"] = false;
    $conn = mysqli_connect("localhost","root", "","cmpe131");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
	$sql="SELECT * FROM accounts WHERE loginStatus=true";
    $results= mysqli_query($conn,$sql);
    if($results){
        $row= mysqli_fetch_assoc($results);
        $sql="UPDATE accounts SET loginStatus=false";
        mysqli_query($conn,$sql);
    }
    $conn->close();
    session_destroy();
?>
<html>
    <p>Signed Out</p>
    <a href="index.php">Back to home page</a>
</html>