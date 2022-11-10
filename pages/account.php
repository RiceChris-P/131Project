<?php include("navbar.php");?>
<?php 
    $conn = mysqli_connect("localhost", "root", "", "cmpe131");
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    session_start();
    // $phoneNumber=returnValFromSql("phoneNumber");
    // $streetAddress=returnValFromSql("streetAddress");
    // $aptNum=returnValFromSql("aptNum");
    // $city=returnValFromSql("city");
    // $zip=returnValFromSql("zip");
    // $nameOnCard=returnValFromSql("nameOnCard");
    // $cardNum=returnValFromSql("cardNum");
    // $cardExp=returnValFromSql("cardExp");
    // $cardCCV=returnValFromSql("cardCCV");
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
    function updateSqlValue($variable, $newValue){
        $sql="UPDATE accounts SET $variable='$newValue' WHERE email='$email'";
        $results=mysqli_query($conn,$sql);
    }
?>
<html>

    <head>
        <title>Check Out</title>
        <link rel="stylesheet" href="../style/checkout.css">
    </head>

    <body>
        <div>
            <div class="checkOutInfo">
                    <form action="">
                        <p>Dev Note: Logged Out</p>
                        <h2>Contact Information</h2>

                        <input type="text" name="firstName" class="" placeholder="First Name">
                        <input type="text" name="lastName" class="" placeholder="Last Name"><br>
                        <input type="text" name="email" class="" placeholder="Email Address"><br>
                        <input type="text" name="phone" class="" placeholder="Phone Number">

                        <h2>Delivery Information</h2>
                        <input type="text" name="address" class="" id="address" placeholder="Street Address"><br>
                        <input type="text" name="aptsuiteunit" class="" placeholder="Apt, suite, etc. (optional)"><br>
                        <input type="text" name="state" class="" placeholder="State">
                        <input type="text" name="city" class="" placeholder="City">
                        <input type="text" name="zip" class="" placeholder="ZIP"><br>
                        
                        <h2>Payment Information</h2>
                        <input type="text" name="cardname" placeholder="Name On Card"><br>
                        <input type="text" name="cardnumber" placeholder="Card Number">
                        <input type="text" name="cardexpiration" placeholder="Exp MM/YY">
                        <input type="text" name="cardcvv" placeholder="Enter CVV"><br>
                        <button type="submit" name="checkoutsubmit">Submit Payment</button>
                    </form>
            </div>

            <div class="cartInCheckOut">
                <h2>Cart</h2>
            </div>
        </div>
        <script>
            document.getElementById("address").value='<?php echo returnValFromSql("state",$email)?>';
            console.log("<?php echo returnValFromSql("state",$email)?>");
        </script>
    </body>
</html>