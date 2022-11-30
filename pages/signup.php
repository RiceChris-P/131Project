

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
    //$conn->close();
?>
<?php
    //form action
    $success=false;
    $passwordNoMatch=false;
    $usernameTaken=false;
    $missingField=false;
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_POST['fname']!=null &&
        $_POST['email']!=null&& 
        $_POST['lname']!=null&&
        (null!=$_POST['password'])&&
        null!=$_POST['retypepass'])
        {
            if($_POST['password']==$_POST['retypepass']){
                $conn = mysqli_connect("localhost","root", "","cmpe131");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                    echo "no connection";
                }
                $fname=$_POST["fname"];
                $lname=$_POST['lname'];
                $email=$_POST['email'];
                $password=$_POST["password"];
                $phone=$_POST["phonenumber"];
                $sql = "SELECT * FROM accounts where email='$email'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                if($num==0){
                    $sql= "INSERT INTO accounts (fname, lastName, email, password, phonenumber) VALUES ('$fname','$lname','$email','$password','$phone');";
                    $result = mysqli_query($conn,$sql);
                    if($result){
                        $_SESSION['login'] = $email;
                        $success=true;
                        header('Location: index.php');
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
    $conn->close();
?>

<html>

    <?php
        if($usernameTaken){
            echo '<script>alert("Account already exists, please log in")</script>';
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

    <header>
        <title>Sign Up</title>
        <link rel="stylesheet" href="../style/form.css">
    </header>

    <body>
      <nav class="navBar">
        <ul>
            <div class="logoElement">
                <img class="logo" src="../assets/logo-transparent.png" alt="">
            </div>
        </ul>
      </nav>
      
        <h1 class="headerOne">Create your HomeBuy account</h1>
        <form action="signup.php" onsubmit="return validateForm()" method="post" class="formBox" >
            <input type="text" name="fname" class="loginFill" placeholder="First Name" required><br>
            <input type="text" name="lname" class="loginFill" placeholder="Last Name" required><br>
            <input type="text" name="email" class="loginFill" id="0"placeholder="Email" required><br>
            <input type="password" name="password" class="loginFill"id="2" placeholder="Password" required><br>
            <input type="password" name="retypepass" class="loginFill" id="3"placeholder="Confirm Password" required><br>
            <input type="text" name="phonenumber" class="loginFill" id="1"placeholder="Phone Number" onkeypress="return isNumberKey(event)" required><br>
            <button type="submit" class="submitButton">Create Account</button>
        </form>
    </body>

</html>
<script>
    function validateForm(){
        let email = document.getElementById(0).value;
        let phone = document.getElementById(1).value;
        if(!email.includes("@")){
            alert("please enter a valid email");
            return false;
        }
        else if(phone.length!=10){
            alert("please enter a valid phone number");
            return false;
        }
        else if(document.getElementById(2).value!=document.getElementById(3).value){
            alert("passwords do not match");
            return false;
        }
        return true; 
    }
    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
    }
</script>