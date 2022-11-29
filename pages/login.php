<?php
    session_start();
    $conn = mysqli_connect("localhost","root", "","cmpe131");
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    //if user is already logged in it redirects user to home page
    if(isSet($_SESSION['login'])){
        header('Location: index.php');
    }
?>
<?php
    //form action
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
                if(@$row["password"]==$password){
                    $_SESSION['login'] = $email;
                    header('Location: shop.php');
                }
                else{
                    echo '<script>alert("Passwords incorrect or email does not exist")</script>';
                }
            }
        }
    }
    $conn->close();
?>

<html>

    <header>
        <title>Sign In</title>
        <link rel="stylesheet" href="../style/form.css">
        <!-- <link rel="stylesheet" href="../style/navbar.css"> -->
    </header>

    <body>
      <nav class="navBar">
        <ul>
            <div class="logoElement">
                <img class="logo" src="../assets/logo-transparent.png" alt="">
            </div>
        </ul>
      </nav>

        <h1 class="headerOne">Sign into your HomeBuy account</h1>
        <form action="login.php" method="post" class="formBox">
            <input type="text" name="email" class="loginFill" placeholder="Email"><br>
            <input type="password" name="password" class="loginFill" placeholder="Password"><br>
            <button type="submit" class="submitButton">Sign In</button>
        </form>
    </body>

</html>
