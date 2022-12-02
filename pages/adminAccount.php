<?php
    session_start();
    if(!$_SESSION['admin']){
        header('Location: admin.php');
    }
    $inputtedEmail=$_POST['emails'];
    $conn=mysqli_connect("localhost","root","","cmpe131");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql="SELECT * FROM accounts WHERE email='$inputtedEmail'";
    $results= mysqli_query($conn,$sql);
    $values=mysqli_fetch_row($results);
    $conn->close();
?>
<!DOCTYPE html>
<html>

<header>
        <title>Admin User Information</title>
        <link rel="stylesheet" href="../style/admin.css">
        <link rel="stylesheet" href="../style/form.css">
        <link rel="stylesheet" href="../style/form.css">
    </header>
    <body>
      <nav class="navBar">
        <ul>
            <div class="logoElement">
                <a href="../index.php"> <img class="logo" src="../assets/logo-transparent.png" alt=""> </a>
            </div>
        </ul>
      </nav>

		<!-- <link rel="stylesheet" type="text/css" href="../style/navbar.css">
		<link rel="stylesheet" type="text/css" href="../style/cart.css"> -->
    <h1 class="adminHeader">User Information </h1>
    <form method="post" action="adminAccountProcessingPage.php">
        
        <label class= "userLabel" for="0">First Name</label><br>
        <input class="userField" type="text" name="firstName" class="" id="0" placeholder="First Name"><br>
        
        <br>
        <label class= "userLabel"for="1">Last Name</label><br>
        <input  class="userField" type="text" name="lastName" class="" id="1" placeholder="Last Name"><br>
        
        <br>
        <label class= "userLabel"for="2">Email</label><br>
        <input  class="userField" type="text" name="email" class="" id="2"placeholder="Email Address"><br>
        <br>

        <label class= "userLabel"for="3">Password</label><br>
        <input class="userField"  type="text" name="password" id="3"><br>
        <br>

        <label class= "userLabel"for="4">Phone</label><br>
        <input  class="userField" type="text" name="phone" class="" id="4" placeholder="Phone Number" onkeypress="return isNumberKey(event)"><br>
        <br>

        <label class= "userLabel"for="5">Address</label><br>
        <input  class="userField" type="text" name="address" class="" id="5" placeholder="Street Address"><br>
        <br>

        <label class= "userLabel"for="6">Apt Suit Unit</label><br>
        <input  class="userField" type="text" name="aptsuiteunit" id="6" class="" placeholder="Apt, suite, etc. (optional)"><br>
        <br>

        <label class= "userLabel"for="7">State</label><br>
        <input  class="userField" type="text" name="state" id="7" class="" placeholder="State"><br>
        <br>

        <label class= "userLabel"for="8">City</label><br>
        <input  class="userField" type="text" name="city" id="8" class="" placeholder="City"><br>
        <br>

        <label class= "userLabel"for="9">Zip</label><br>
        <input  class="userField" type="text" name="zip" id="9" class="" placeholder="ZIP" onkeypress="return isNumberKey(event)"><br>
        <br>

        <label class= "userLabel"for="10">Card Name</label><br>
        <input  class="userField" type="text" name="cardname" id="10" placeholder="Name On Card"><br>
        <br>

        <label class= "userLabel"for="11">Card Number</label><br>
        <input  class="userField" type="text" name="cardnumber" id="11" placeholder="Card Number" onkeypress="return isNumberKey(event)"><br>
        <br>

        <label class= "userLabel"for="12">Expiration Date</label><br>
        <input  class="userField" type="text" name="cardexpiration" id="12" placeholder="Exp MM/YY"><br>
        <br>

        <label class= "userLabel"for="13">CVV</label><br>
        <input  class="userField" type="text" name="cardcvv" id="13" placeholder="Enter CVV" onkeypress="return isNumberKey(event)"><br>
        <br>

        <input type="hidden" name="origSelectedEmail" value="<?php echo $inputtedEmail?>">
        <br>
        <button class = "updateInfoButton" type="submit" name="updateAccount">Update Information</button>
    </form>
</html>
<script>
    var accountValues=<?php echo json_encode($values);?>;
    for(let i=0;i<accountValues.length;i++){
        if(accountValues[i]!=null){
            document.getElementById(i).value=accountValues[i];
        }
    }
    function validateForm(){
        let email = document.getElementById("2").value;
        let phone = document.getElementById("4").value;
        if(!email.includes("@")){
            alert("please enter a valid email");
            return false;
        }
        else if(phone.length!=10){
            alert("please enter a valid phone number");
            return false;
        }
        else{
            return true; 
        }
    }
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
