<!DOCTYPE html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_POST["email"]!=null && $_POST["password"]!=null){
            $email= $_POST["email"];
            $password= $_POST["password"];
            $conn = mysqli_connect("localhost","root", "","cmpe131");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql="SELECT password FROM accounts WHERE email='$email'";
            $results= mysqli_query($conn,$sql);
            if($results){
                $row= mysqli_fetch_assoc($results);
                if($row["password"]===$password){
                    $sql="UPDATE accounts SET loginStatus=true WHERE email='$email'";
                    mysqli_query($conn,$sql);
                    header('Location: shop.php');
                }
                else{
                    echo '<script>alert("Passwords incorrect or email does not exist")</script>';
                }
            }
        }
    }
?>
<html>
    <header>
        <title>Sign In</title>
        <link rel="stylesheet" href="form.css">
    </header>
    <body>
        <img class="logo" src="assets/logo-transparent.png" alt="">
        <h1 class="headerOne">Sign into your HomeBuy account</h1>
        <form action="/login.php" method="post" class="formBox">
            <input type="text" name="email" class="loginFill" placeholder="Email"><br>
            <input type="password" name="password" class="loginFill" placeholder="Password"><br>
            <button type="submit" class="submitButton">Sign In</button>
        </form>
    </body>
</html>