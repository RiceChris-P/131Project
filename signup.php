<?php
$alert=false;
    if(isSet($_POST["fname"])&&isSet($_POST["email"])&&isSet($_POST["password"])&&isSet($_POST["retypepass"])){
        if($_POST["password"]==$_POST["retypepass"]){
            $password=$_POST["password"];
            echo $password;
        }
        else
        {
            $alert=true;
            echo"PASSWORDS DONT MATCCH";
            echo '<script>alert("Passwords do not match")</script>';
            header("Location: navbar.html");

        }
        $fullName=$_POST["fname"];
        $email=$_POST["email"];
    }
    else{
        header('Location: /navbar.html');
    }
?>
<html>
    Sign up complete
    <a href=login.php>Click to Login</a>
</html>
