<?php
    $success=false;
    $passwordNoMatch=false;
    $usernameTaken=false;
    $missingField=false;
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_POST['fname']!=null && 
        $_POST['email']!=null&&
        (null!=$_POST['password'])&&
        null!=$_POST['retypepass'])
        {
            if($_POST['password']==$_POST['retypepass']){
                $conn = mysqli_connect("localhost","root", "","cmpe131");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                    echo "no connection";
                }
                $fullName=$_POST["fname"];
                $email=$_POST['email'];
                $password=$_POST["password"];
                $sql = "SELECT * FROM accounts where email='$email'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result); 
                if($num==0){
                    $sql= "INSERT INTO accounts VALUES('$email','$password','$fullName')";
                    $result = mysqli_query($conn,$sql);
                    if($result){
                        $success=true;
                    }
                }
                else{
                    $usernameTaken=true;
                }
            }
            else
            {
                $passwordNoMatch=true;
            }

        }
        else{
            $missingField=true;
        }
    }
?>
<html>
    <?php
        if($usernameTaken){
            echo '<script>alert("You already have an account, please log in")</script>';
        }
        if($success){
            echo '<script>alert("Account created, please log in")</script>';
        }
        if($passwordNoMatch){
            echo '<script>alert("Passwords do not match")</script>';

        }
        if($missingField){
            echo '<script>alert("Missing Field")</script>';

        }

    ?>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="navstyle.css">
    <div id="nav-placeholder">

    </div>
    <nav>
        <ul>
            <img class="logo" src="logo-transparent.png" alt="">
            <li><a href="login.php">Sign In</a></li>
            <li><a href="signup.php">Sign Up</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="aboutus.html">About Us</a></li>
            <li><a href="index.html">Home</a></li>
        </ul>
    </nav>
    <form action="/signup.php" method="post">
        <h2>Sign Up</h2>
        <input type="text" name="fname" placeholder="Full Name..."><br>
        <input type="text" name="email" placeholder="Email Address..."><br>
        <input type="password" name="password" placeholder="Password..."><br>
        <input type="password" name="retypepass" placeholder="Retype Password..."><br>
        <button type="submit">Sign Up</button>
    </form>
    <body class="homeBody">

    </body>
</html>