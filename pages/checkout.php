<!DOCTYPE html>

<?php
    include("navbar.php");
    $conn = mysqli_connect("localhost", "root", "", "cmpe131");

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }

    if(!isset($_SESSION['login'])) {
        $success=false;
        $passwordNoMatch=false;
        $usernameTaken=false;
        $missingField=false;

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = $_POST['firstName'];
            $lname = $_POST['lastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $aptsuite = $_POST['aptsuiteunit'];
            $state = $_POST['state'];
            $city = $_POST['city'];
            $zip = $_POST['zip'];
            $cardname = $_POST['cardname'];
            $cardnum = $_POST['cardnumber'];
            $cardexp = $_POST['cardexpiration'];
            $cardcvv = $_POST['cardcvv'];

            if($fname != null && $lname != null && $email != null) {
                $contactinfo = json_encode(array(
                    'firstName' => $fname,
                    'lastName' => $lname,
                    'email' => $email,
                    'phone' => $email
                ), JSON_FORCE_OBJECT);

                if($address != null && $state != null && $city != null && $zip != null) {
                    $deliveryinfo = json_encode(array(
                        'address' => $address,
                        'aptsuiteetc' => $aptsuite,
                        'state' => $state,
                        'city' => $city,
                        'zip' => $zip
                    ), JSON_FORCE_OBJECT);

                    if($cardname != null && $cardnum != null && $cardexp != null && $cardcvv != null) {
                        $paymentinfo = json_encode(array(
                            'cardname' => $cardname,
                            'cardnumber' => $cardnum,
                            'cardexpiration' => $cardexp,
                            'cardcvv' => $cardcvv
                        ), JSON_FORCE_OBJECT);


                        $ordernumTaken = true;
                        $ordernum = "";
                        while($ordernumTaken) {
                            for($x = 0; $x <= 20; $x++) {
                                $ordernum .= rand(0,9);
                            }
                            
                            $sql = "SELECT * FROM orders where ordernum='$ordernum'";
                            $result = mysqli_query($conn, $sql);
                            $num = mysqli_num_rows($result);
                            if($num  == 0) {
                                $ordernumTaken = false;
                            }
                        }
                        $sql = "SELECT * FROM orders";
                        $result = mysqli_query($conn, $sql);
                        $sql= "INSERT INTO orders (ordernum, email, contactinfo, deliveryinfo, paymentinfo) VALUES ('$ordernum', '$email','$contactinfo','$deliveryinfo','$paymentinfo');";
                        $result = mysqli_query($conn,$sql);
                        if($result) {
                            $success=true;
                            header('Location: orderconf.php');
                        }
                    }
                    else {
                        $missingField = true;
                    }
                } 
                else {
                    $missingField = true;
                }
            }
            else if($fname != null && $lname != null && $email != null && $pass != null) {
                
            }
        }
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
                <?php if(isset($_SESSION['login'])) { ?>
                    <script>"User is logged in."</script>
                    <h1>Contact Information</h1>
                    <form action="">
                        
                        <input type="text" name="address" class="" placeholder="Street Address"><br>
                        <input type="text" name="aptsuiteunit" class="" placeholder="Apt, suite, rtc. (optional)"><br>
                        <input type="text" name="city" class="" placeholder="City"><br>
                        <input type="text" name="state" class="" placeholder="State"><br>
                        <input type="text" name="zip" class="" placeholder="ZIP"><br>

                    </form>
                <?php } else { ?>
                    <form action="checkout.php" method="post">
                        <script>console.log("User is logged out.")</script>
                        <h2>Contact Information</h2>

                        <input type="text" name="firstName" class="" placeholder="First Name">
                        <input type="text" name="lastName" class="" placeholder="Last Name"><br>
                        <input type="text" name="email" class="" placeholder="Email Address"><br>
                        <input type="text" name="phone" class="" placeholder="Phone Number"><br>
                        <label class=""><input type="checkbox" id="check" name="createaccount" class="" onclick="validate()">Create Account?</label><br>
                        <input type="password" id="password" name="password" class="passCreation" placeholder="Password"><br>
                        <input type="password" id="retypepass" name="retypepass" class="passCreation" placeholder="Confirm Password"><br>

                        <script>
                            function validate() {
                                let check = document.getElementById("check");
                                if(check.checked) {
                                    document.getElementById("password").style.visibility = "visible";
                                    document.getElementById("retypepass").style.visibility = "visible";
                                }
                                else {
                                    document.getElementById("password").style.visibility = "hidden";
                                    document.getElementById("retypepass").style.visibility = "hidden";
                                }
                            }
                        </script>
                        

                        <h2>Delivery Information</h2>
                        <input type="text" name="address" class="" placeholder="Street Address"><br>
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
                <?php } ?> 
            </div>

            <div class="cartInCheckOut">
                <h2>Cart</h2>
            </div>
        </div>
    </body>
</html>