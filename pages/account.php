<?php 
include("navbar.php");
?>
<?php 
    $email=$_SESSION['login'];
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_POST['email']) { 
            updateSqlValue("email",$_POST['email']);
            $_SESSION['login'] = $_POST['email'];
        }
        if($_POST['firstName']) {
            updateSqlValue("fname",$_POST['firstName']);
        }
        if($_POST['lastName']) {
            updateSqlValue("lastName",$_POST['lastName']);
        } 
        if($_POST['phone']) {
            updateSqlValue("phonenumber",$_POST['phone']);
        }
        if($_POST['address']) {
            updateSqlValue("address",$_POST['address']);
        }
        if($_POST['aptsuiteunit']) {
            updateSqlValue("aptOrSuite",$_POST['aptsuiteunit']);
        } 
        if($_POST['state']) {
            updateSqlValue("state",$_POST['state']);
        }
        if($_POST['city']) {
            updateSqlValue("city",$_POST['city']);
        }
        if($_POST['zip']) {
            updateSqlValue("zipCode",$_POST['zip']);
        }
        if($_POST['cardname']) {
            updateSqlValue("nameOnCard",$_POST['cardname']);
        }
        if($_POST['cardnumber']) {
            updateSqlValue("cardNum",$_POST['cardnumber']);
        }
        if($_POST['cardexpiration']) {
            updateSqlValue("cardExp",$_POST['cardexpiration']);
        }
        if($_POST['cardcvv']) {
            updateSqlValue("cardCVV",$_POST['cardcvv']);
        }
    }
    
    //input name of sql variable and the new value you want to set the variable to
    //updateSqlValue("variable name in sql datatbse", "new value for said variable)
    function updateSqlValue($variable,$newValue){
        $userEmail=$_SESSION['login'];
        $conn = mysqli_connect("localhost", "root", "", "cmpe131");
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql="UPDATE accounts SET $variable='$newValue' WHERE email='$userEmail'";
        mysqli_query($conn,$sql);
        $conn->close();
    }

    //get account info
    $conn = mysqli_connect("localhost", "root", "", "cmpe131");
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    $ID = $_SESSION['login'];
    $query = "SELECT * FROM accounts WHERE email=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $ID);
	$stmt->execute();
    $result = $stmt->get_result();
    $account = $result->fetch_assoc();
    $_SESSION['account'] = $account;
    $conn->close();
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Account</title>
        <link rel="stylesheet" href="../style/checkout.css">
    </head>

    <body>
        <div>
            <div class="checkOutInfo">
                    <form  action="account.php" method="post">
                        <h2>Contact Information</h2>
                        <div id="contactContainer">
                            <div class="form">
                                <label for="firstName" class="label">First Name: </label>
                                <br>
                                <input type="text" name="firstName" class="input" id="firstName" placeholder="<?php $temp = $_SESSION['account']; if($temp['fname']){echo $temp['fname'];} else{echo "First Name";}?>">
                            </div>
                            <div class="form">
                                <label for="lastName" class="label">Last Name: </label>
                                <br>
                                <input type="text" name="lastName" class="input" id="lastName" placeholder="<?php $temp = $_SESSION['account']; if($temp['lastName']){echo $temp['lastName'];} else{echo "Last Name";}?>">
                            </div>
                            <div class="form">
                                <label for="email" class="label">Email Address: </label>
                                <br>
                                <input type="text" name="email" class="input" id="email"placeholder="<?php $temp = $_SESSION['account']; if($temp['email']){echo $temp['email'];} else{echo "Email Address";};?>">
                            </div>
                            <div class="form">
                                <label for="phone" class="label">Phone Number: </label>
                                <br>
                                <input type="text" minlength="10" maxlength="10" name="phone" class="input" id="phone" placeholder="<?php $temp = $_SESSION['account']; if($temp['phonenumber']){echo $temp['phonenumber'];} else{echo "Phone Number";};?>" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                        <h2>Delivery Information</h2>
                        <div id="deliveryContainer">
                            <div class="form">
                                <label for="stAddress" class="label">Address:  </label>
                                <br>
                                <input type="text" name="address" class="" id="stAddress" placeholder="<?php $temp = $_SESSION['account']; echo $temp['address'];?>"><br>
                            </div>
                            <div class="form">
                                <label for="apt" class="label">Apt/Suite:  </label>
                                <br>
                                <input type="text" name="aptsuiteunit" id="apt" class="" placeholder="<?php $temp = $_SESSION['account']; if($temp['aptOrSuite']){echo $temp['aptOrSuite'];} else{echo "Apt, suite, etc. (optional)";}?>"><br>
                            </div>
                            <div class="form">
                                <label for="state" class="label">State:  </label>
                                <br>
                                <input type="text" name="state" id="state" class="" placeholder="<?php $temp = $_SESSION['account']; if($temp['state']){echo $temp['state'];} else{echo "State";}?>">
                            </div>
                            <div class="form">
                                <label for="city" class="label">City:  </label>
                                <br>
                                <input type="text" name="city" id="city" class="" placeholder="<?php $temp = $_SESSION['account']; if($temp['city']){echo $temp['city'];} else{echo "City";}?>">
                            </div>
                            <div class="form">
                                <label for="zipCode" class="label">Zip:  </label>
                                <br>
                                <input type="text" minlength="5" maxlength="5" name="zip" id="zipCode" class="" placeholder="<?php $temp = $_SESSION['account']; if($temp['zipCode']){echo $temp['zipCode'];} else{echo "ZIP";}?>" onkeypress="return isNumberKey(event)"><br>
                            </div>
                        </div>
                        
                        <h2>Payment Information</h2>
                        <div id="paymentContainer">
                            <div class="form">
                                <label for="cardName" class="label">Name On Card:  </label>
                                <br>
                                <input type="text" name="cardname" id="cardName" placeholder="<?php $temp = $_SESSION['account']; if($temp['nameOnCard']){echo $temp['nameOnCard'];} else{echo "Name On Card";}?>"><br>
                            </div>
                            <div class="form">
                                <label for="cardNum" class="label">Card Number:  </label>
                                <br>
                                <input type="text" minlength="15" maxlength="16" name="cardnumber" id="cardNum" placeholder="<?php $temp = $_SESSION['account']; if($temp['cardNum']){echo $temp['cardNum'];} else{echo "Card Number";}?>" onkeypress="return isNumberKey(event)">
                            </div>
                            <div class="form">
                                <label for="cardExp" class="label">Exp MM/YY:  </label>
                                <br>
                                <input type="text" name="cardexpiration" id="cardExp" placeholder="<?php $temp = $_SESSION['account']; if($temp['cardExp']){echo $temp['cardExp'];} else{echo "Exp MM/YY";}?>">
                            </div>
                            <div class="form">
                                <label for="cardCVV" class="label">Enter CVV:  </label>
                                <br>
                                <input type="text" minlength="3" maxlength="4" name="cardcvv" id="cardCVV"placeholder="<?php $temp = $_SESSION['account']; if($temp['cardCVV']){echo $temp['cardCVV'];} else{echo "Enter CVV";}?>" onkeypress="return isNumberKey(event)"><br>
                            </div>
                        </div>
                        <br>
                        <button type="submit" name="checkoutsubmit">Update Information</button>
                    </form>
            </div>

            
        </div>
    </body>

    <style>
        a:link {color: black; text-align: center; font-family: Arial, Helvetica, sans-serif;}
    </style>
</html>
<script>
    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>