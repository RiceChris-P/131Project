<?php 
include("navbar.php");
?>
<?php 
    $conn = mysqli_connect("localhost", "root", "", "cmpe131");
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    $email=$_SESSION['login'];
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_POST['email']!=$email&&$_POST['email']!=null){
            $newEmail=$_POST['email'];
            $sql="UPDATE accounts SET email=$newEmail WHERE email='$userEmail'";
            $results=mysqli_query($conn,$sql);
        }
        //updateSqlValue(name of variable inside sql, new value from form)
        updateSqlValue("fname",$_POST['firstName']);
        updateSqlValue("lastName",$_POST['lastName']);
        updateSqlValue("phonenumber",$_POST['phone']);
        updateSqlValue("address",$_POST['address']);
        updateSqlValue("aptOrSuite",$_POST['aptsuiteunit']);
        updateSqlValue("state",$_POST['state']);
        updateSqlValue("city",$_POST['city']);
        updateSqlValue("zipCode",$_POST['zip']);
        updateSqlValue("nameOnCard",$_POST['cardname']);
        updateSqlValue("cardNum",$_POST['cardnumber']);
        updateSqlValue("cardExp",$_POST['cardexpiration']);
        updateSqlValue("cardCVV",$_POST['cardcvv']);
    }
    //input sql variable, returns the sql variables value
    function returnValFromSql($value){
        $userEmail=$_SESSION['login'];
        $conn = mysqli_connect("localhost", "root", "", "cmpe131");
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql="SELECT $value FROM accounts WHERE email='$userEmail';";
		$results= mysqli_query($conn,$sql);
        if($results){
            $temp= mysqli_fetch_assoc($results);
            return $temp[$value];
        }
        $conn->close();
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
?>
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

                        <input type="text" name="firstName" class="" id="firstName" placeholder="First Name">
                        <input type="text" name="lastName" class="" id="lastName" placeholder="Last Name"><br>
                        <input type="text" name="email" class="" id="email"placeholder="Email Address"><br>
                        <input type="text" name="phone" class="" id="phone" placeholder="Phone Number" onkeypress="return isNumberKey(event)">

                        <h2>Delivery Information</h2>
                        <input type="text" name="address" class="" id="stAddress" placeholder="Street Address"><br>
                        <input type="text" name="aptsuiteunit" id="apt" class="" placeholder="Apt, suite, etc. (optional)"><br>
                        <input type="text" name="state" id="state" class="" placeholder="State">
                        <input type="text" name="city" id="city" class="" placeholder="City">
                        <input type="text" name="zip" id="zipCode" class="" placeholder="ZIP" onkeypress="return isNumberKey(event)"><br>
                        
                        <h2>Payment Information</h2>
                        <input type="text" name="cardname" id="cardName" placeholder="Name On Card"><br>
                        <input type="text" name="cardnumber" id="cardNum" placeholder="Card Number" onkeypress="return isNumberKey(event)">
                        <input type="text" name="cardexpiration" id="cardExp" placeholder="Exp MM/YY">
                        <input type="text" name="cardcvv" id="cardCVV"placeholder="Enter CVV" onkeypress="return isNumberKey(event)"><br>
                        <button type="submit" name="checkoutsubmit">Update Information</button>
                    </form>
            </div>

            <div class="cartInCheckOut">
                <h2>Cart</h2>
            </div>
        </div>
        <script>
            //fills form with current account info
            document.getElementById("firstName").value='<?php echo returnValFromSql("fname");?>';
            document.getElementById("lastName").value='<?php echo returnValFromSql('lastName');?>';
            document.getElementById("stAddress").value='<?php echo returnValFromSql("address");?>';
            document.getElementById("email").value='<?php echo $_SESSION['login']?>';
            document.getElementById("phone").value='<?php echo returnValFromSql("phone");?>';

            document.getElementById("apt").value='<?php echo returnValFromSql("aptOrSuite");?>';
            document.getElementById("state").value='<?php echo returnValFromSql("state");?>';
            document.getElementById("city").value='<?php echo returnValFromSql("city");?>';
            document.getElementById("zipCode").value='<?php echo returnValFromSql("zipCode");?>';

            document.getElementById("cardName").value='<?php echo returnValFromSql("nameOnCard");?>';
            document.getElementById("cardNum").value='<?php echo returnValFromSql("cardNum");?>';
            document.getElementById("cardExp").value='<?php echo returnValFromSql("cardExp");?>';
            document.getElementById("cardCVV").value='<?php echo returnValFromSql("cardCVV");?>';
        </script>
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