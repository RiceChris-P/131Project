<html>
    <head>
        <title>Processing</title>
    </head>
    <body>
        <h1>Processing</h1>
<?php
    if(isset($_POST["username"]) && isset($_POST["password"])){
        if($_POST["username"]&&$_POST["password"]){
            $username= $_POST["username"];
            $password= $_POST["password"];
        }
        $conn = mysqli_connect("localhost","root", "","cmpe131");
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO students (username,password) VALUES ('$username', '$password')";
        $results=mysqli_query($conn, $sql);
        if ($results) {
            echo "User has been added"."<br>";
        } 
        else {
            echo mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    else{
        echo "Either Username or Password is empty";
    }
?>
<a href="Registration.html">Back to Home</a>
</body>
</html>