<!DOCTYPE html>

<?php
    session_start();
    include("handler/setCartSession.php");
    include("handler/checkoutHandler.php");

    $conn = mysqli_connect("localhost","root", "","cmpe131");
	if(!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}

    if(empty(json_decode($_SESSION['cart'], true))) {
        header('Location: shop.php');
    }

    if(isset($_SESSION['login'])) {
        $ID = $_SESSION['login'];
    }
    $query = "SELECT * FROM accounts WHERE email=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $ID);
	$stmt->execute();
    $result = $stmt->get_result();
    $account = $result->fetch_assoc();
    $_SESSION['account'] = $account;

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $isLogin = isset($_SESSION['login']);

        //Contact Info
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        if(!$isLogin) {
            $email = $_POST['email'];
        }
        else {
            $email = $_SESSION['login'];
        }
        $phone = $_POST['phone'];

        //Create Account
        $createPass = false;
        if(!$isLogin) {
            $password = $_POST['password'];
            $retypepass = $_POST['retypepass'];
            $createPass = '<script>createAccountValidation();</script>';
        }

        //Delivery Info
        $address = $_POST['address'];
        $aptsuiteetc = $_POST['aptsuiteunit'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];

        //Payment Info
        $cardname = $_POST['cardname'];
        $cardnum = $_POST['cardnum'];
        $cardexp = $_POST['cardexp'];
        $cardcvv = $_POST['cardcvv'];

        //Cart
        $items = $_SESSION['cart'];

        //JSON Objects 
        $contact = json_encode(array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'phone' => $phone
        ), JSON_FORCE_OBJECT);

        $delivery = json_encode(array(
            'address' => $address,
            'aptsuiteetc' => $aptsuiteetc,
            'state' => $state,
            'city' => $city,
            'zip' => $zip
        ), JSON_FORCE_OBJECT);

        $payment = json_encode(array(
            'cardname' => $cardname,
            'cardnumber' => $cardnum,
            'cardexpdate' => $cardexp,
            'cardcvv' => $cardcvv
        ), JSON_FORCE_OBJECT);
        
        if($createPass && !$isLogin) {
            sendOrder($conn, $email, $password, $createPass, $items, $contact, $delivery, $payment);
        } 
        else {
            sendOrder2($conn, $isLogin, $email, $items, $contact, $delivery, $payment);
        }

        header("Location: order.php");
    }

?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" href="../style/checkout.css">
        <link rel="stylesheet" href="../style/navbar.css">
		<link rel="stylesheet" href="../style/checkoutcart.css">
    </head>

    <body>
        <nav class="checkoutNavBar">
            <ul>
                <div class="headerElement">
                    <h1 class="checkoutHeader">Checkout</h1>
                </div>
            </ul>
        </nav>

        <div class="checkoutContainer">
            <div class="checkOutInfo">
                <?php 
                $loggedIn = isset($_SESSION['login']);
                if($loggedIn) { 
                ?>
                    <form action="checkout.php" method="post" class="guestForm" onsubmit="return validateForm()">
                        
                        <div class="contact">
                            <h2>Contact Information</h2>

                            <input type="text" name="firstName" id="firstName" class="" required value="<?php $temp = $_SESSION['account']; if($temp['fname']){echo $temp['fname'];}?>" placeholder="First Name">
                            <input type="text" name="lastName" id="lastName" class="" required value="<?php $temp = $_SESSION['account']; if($temp['lastName']){echo $temp['lastName'];}?>" placeholder="Last Name"><br>
                            <input type="text" name="phone" id="phone" required minlength="10" maxlength="10" class="" value="<?php $temp = $_SESSION['account']; if($temp['phonenumber']){echo $temp['phonenumber'];}?>" onkeypress="return isNumberKey(event)" placeholder="Phone Number"><br>

                        </div>
                       

                        <div class="delivery">
                            <h2>Delivery Information</h2>
                                <input type="text" name="address" required id="address" class="" value="<?php $temp = $_SESSION['account']; echo $temp['address'];?>" placeholder="Street Address"><br>
                                <input type="text" name="aptsuiteunit" id="aptsuiteunit" class="" value="<?php $temp = $_SESSION['account']; if($temp['aptOrSuite']){echo $temp['aptOrSuite'];}?>" placeholder="Apt, suite, etc. (optional)"><br>
                                <input type="text" name="state" id="state" required minlength="2" maxlength="2" class="" value="<?php $temp = $_SESSION['account']; if($temp['state']){echo $temp['state'];}?>" placeholder="State">
                                <input type="text" name="city" id="city" required class="" value="<?php $temp = $_SESSION['account']; if($temp['city']){echo $temp['city'];}?>" placeholder="City">
                                <input type="text" name="zip" id="zip" required minlength="5" maxlength="5"class="" value="<?php $temp = $_SESSION['account']; if($temp['zipCode']){echo $temp['zipCode'];}?>" onkeypress="return isNumberKey(event)" placeholder="ZIP"><br>              
                        </div>

                        <div class="payment">
                            <h2>Payment Information</h2>
                            <input type="text" name="cardname" id="cardname" required value="<?php $temp = $_SESSION['account']; if($temp['nameOnCard']){echo $temp['nameOnCard'];}?>" placeholder="Name On Card"><br>
                            <input type="text" name="cardnum" id="cardnum" required minlength="15" maxlength="16"value="<?php $temp = $_SESSION['account']; if($temp['cardNum']){echo $temp['cardNum'];}?>" onkeypress="return isNumberKey(event)" placeholder="Card Number">
                            <input type="text" name="cardexp" id="cardexp" required minLength="5" maxlength="5"value="<?php $temp = $_SESSION['account']; if($temp['cardExp']){echo $temp['cardExp'];}?>" placeholder="Exp. MM/YY">
                            <input type="text" name="cardcvv" id="cardcvv" required minlength="3" maxlength="4"value="<?php $temp = $_SESSION['account']; if($temp['cardCVV']){echo $temp['cardCVV'];}?>" onkeypress="return isNumberKey(event)" placeholder="CVV"><br>
                            <button type="submit" name="checkoutsubmit" id="checkoutsubmit">Submit Payment</button>
                        </div>

                    </form>
                <?php } else { ?>
                    <form action="checkout.php" method="post" class="guestForm" onsubmit="return validateForm()">
                        <script>console.log("User is logged out.")</script>
                        <div class="contact">
                            <h2>Contact Information</h2>

                            <input type="text" name="firstName" id="firstName" required class="" placeholder="First Name">
                            <input type="text" name="lastName" id="lastName" required class="" placeholder="Last Name"><br>
                            <input type="text" name="email" id="email" class="" required placeholder="Email Address"><br>
                            <input type="text" name="phone" id="phone" required minlength="10" maxlength="10" class="" placeholder="Phone Number" onkeypress="return isNumberKey(event)"><br>
                            <label class=""><input type="checkbox" id="check" name="createaccount" class="" onclick="validate()">Create Account?</label><br>
                            <input type="password" id="password" name="password" class="passCreation" placeholder="Password"><br>
                            <input type="password" id="retypepass" name="retypepass" class="passCreation" placeholder="Confirm Password"><br>

                        </div>
                        
                        <div class="delivery">
                            <h2>Delivery Information</h2>
                            <input type="text" name="address" id="address" class="" placeholder="Street Address"><br>
                            <input type="text" name="aptsuiteunit" id="aptsuiteunit"class="" placeholder="Apt, suite, etc. (optional)"><br>
                            <input type="text" name="state" id="state" minlength="2" maxlength="2" class="" placeholder="State">
                            <input type="text" name="city" id ="city" class="" placeholder="City">
                            <input type="text" name="zip" id="zip"required minlength="5" maxlength="5" class="" placeholder="ZIP" onkeypress="return isNumberKey(event)"><br>
                        </div>
                        
                        <div class="payment">
                            <h2>Payment Information</h2>
                            <input type="text" name="cardname" id="cardname" required placeholder="Name On Card"><br>
                            <input type="text" name="cardnum" id="cardnum" required minlength="15" maxlength="16" placeholder="Card Number" onkeypress="return isNumberKey(event)">
                            <input type="text" name="cardexp" id="cardexp" required minLength="5" maxlength="5" placeholder="Exp MM/YY">
                            <input type="text" name="cardcvv" id="cardcvv" required minlength="3" maxlength="4" placeholder="Enter CVV" onkeypress="return isNumberKey(event)"><br>
                            <button type="submit" name="checkoutsubmit" id="checkoutsubmit">Submit Payment</button>
                        </div>
                    </form>
                <?php } ?> 
            </div>

            <div class="cartInCheckOut">
                <h2>Cart</h2>
                <div class="cart" id="cart">
                    <div id="items" class="items">
                        <div class="cartItemContainer" id="cartItemContainer">
                        </div>
                    </div>
                    
                    <div class="cartTotal">
                        <p class="cartTotalText">Weight:</p>
                        <p class="cartTotalText" id="cartTotalWeightText">0 lbs</p>
                        <p class="cartTotalText">Subtotal:</p>
                        <p class="cartTotalText" id="cartTotalText" >$0.00</p>
                        <p class="cartTotalText">Weight Fee:</p>
                        <p class="cartTotalText" id="cartWeightFeeText" >$0.00</p>
                        <p class="cartTotalText">Total:</p>
                        <p class="cartTotalText" id="cartRealTotalText" >$0.00</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
   <script src="script/validate.js"></script>
   <script src="script/cart.js"></script>
</html>
