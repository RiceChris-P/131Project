<?php
    $logged_in=false;
    if(isset($_POST["username"]) && isset($_POST["password"])){
        if($_POST["username"]&&$_POST["password"]){
            $username= $_POST["username"];
            $password= $_POST["password"];
        }
        $conn = mysqli_connect("localhost","root", "","cmpe131");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql="SELECT password FROM students WHERE username='$username'";
        $results= mysqli_query($conn,$sql);
        if($results){
            $row= mysqli_fetch_assoc($results);
            if($row["password"]===$password){
                echo "<h2>Login Suceessful</h2>";
            }
            else{
                echo "password incorrect";
            }
        }
    }
    else{
    }
?>
<html>
<link rel="stylesheet" href="navstyle.css">
    <ul>
        <li><a href="login.php">Sign In</a></li>
        <li><a href="navbar.html">Sign Up</a></li>
        <li><a href="">Shop</a></li>
        <li><a href="">About Us</a></li>
        <li><a href="homepage.html">Home</a></li>
    </ul>
    <form action="/login.php" method="post">
        <input type="text" name="loginemail" placeholder="Email"><br>
        <input type="password" name="loginpword" placeholder="Password"><br>
        <button type="submit">Login</button>
        </form>
    <?php
        if($logged_in){
            echo "<h2>Success</h2>";
        }
    ?>
</html>