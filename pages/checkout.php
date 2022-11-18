<!DOCTYPE html>

<?php
    include("navbar.php");
    
    $conn = mysqli_connect("localhost", "root", "", "cmpe131");

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    else {
        echo '<script>console.log("Connection Successful!")</script>';
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo '<script>console.log("POST Request Found!")</script>';

        $formSuccess = false;
        $orderSuccess = false;

        //Contact Info
        $contactInfo = false;
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        //Create Accounts
        $createAccount = false;
        $password = $_POST['password'];
        $retypepass = $_POST['retypepass'];

        //Delivery Info
        $deliveryInfo = false;
        $address = $_POST['address'];
        $aptsuiteetc = $_POST['aptsuiteunit'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];

        //Payment Info
        $paymentInfo = false;
        $cardname = $_POST['cardname'];
        $cardnum = $_POST['cardnum'];
        $cardexp = $_POST['cardexp'];
        $cardcvv = $_POST['cardcvv'];

        if($firstName != null && $lastName != null && $email != null && $phone != null) {
            $passPhone = false;
            $passEmail = false;

            if(strlen($phone) != 10) {
                echo '<script>alert("Invalid phone number! Must be 10 digits long, e.g., \"4159321576\".")</script>';
            }
            else {
                $passPhone = true;
            }

            if(!str_contains($email, '@') or !str_contains($email, '.')) {
                echo '<script>alert("Invalid email address! Must be in the correct format, e.g., \"name@domain.com\".")</script>';
            }
            else {
                $passEmail = true;
            }

            if($passPhone && $passEmail) {
                $contactInfo = true;
            }
        }
        else {
            echo '<script>alert("Missing field input in contact info!")</script>';
        }

        if($password != null && $retypepass != null) {
            $createAccount = true;
        }

        if($address != null && $state != null && $city != null && $zip != null) {
            $passState = false;
            $passZip = false;

            if(strlen($state) == 2) {
                $passState = true;
            }
            else {
                echo '<script>alert("Invalid state! Must be the two lettered-long abbreviation, e.g., CA for California.")</script>';
            }

            if(strlen($zip) == 5) {
                $passZip = true;
            }
            else {
                echo '<script>alert("Invalid zip code! Must be the five digits long, e.g., 94134.")</script>';
            }

            if($passState && $passZip) {
                $deliveryInfo = true;
            }
        }
        else {
            echo '<script>alert("Missing field input in delivery info!")</script>';
        }

        if($cardname != null && $cardnum != null && $cardexp != null && $cardcvv != null) {
            $passNum = false;
            $passExp = false;
            $passCVV = false;
            if(strlen($cardnum) == 15 or strlen($cardnum) == 16) {
                $passNum = true;
            }
            else {
                echo '<script>alert("Invalid card number!")</script>';
            }

            if(strlen($cardcvv) == 3 or strlen($cardcvv) == 4) {
                $passCVV = true;
            }
            else {
                echo '<script>alert("Invalid card cvv!")</script>';
            }

            if(strlen($cardexp) == 5) {
                $passExp = true;
            }
            else {
                echo '<script>alert("Invalid card expiration date! Must be MM/YY, e.g., 01/23")</script>';
            }

            if($passCVV && $passNum && $passExp) {
                $paymentInfo = true;
            }
        }
        else {
            echo '<script>alert("Missing field input!")</script>';
        }

        if($contactInfo && $deliveryInfo && $paymentInfo) {
            $formSuccess = true;

            echo '<script>console.log("Form submitted!")';
        }
        else {
            header('Refresh: 0');
        }

        //Passed Checks

        //Creating JSON objects
        if($formSuccess) {
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

            echo '<script>console.log("JSON objects created!")';
        }

        //Creating Account and Sending Order
        if($createAccount && $formSuccess) {
            echo '<script>console.log("Creating Account...")</script>';

            if($password == $retypepass) {
                echo '<script>console.log("Passwords check passed!")</script>';

                //Checking unique email
                $query = "SELECT * FROM accounts WHERE email='$email'";
                $result = mysqli_query($conn, $query);
                $rows = mysqli_num_rows($result);

                if($rows == 0) {
                    echo '<script>console.log("Unique user check passed!")</script>';
                    //Generating random order number
                    $orderNumTaken = true;
                    $orderNum = "";

                    while($orderNumTaken) {

                        for($x= 0; $x <= 20; $x ++) {
                            $orderNum .= rand(0, 9);
                        }

                        $queryTwo = "SELECT * FROM orders WHERE ordernum='$orderNum'";
                        $resultTwo = mysqli_query($conn, $queryTwo);
                        $rowsTwo = mysqli_num_rows($resultTwo);

                        if($rowsTwo == 0) {
                            $orderNumTaken = false;
                            echo '<script>console.log("Order number generated")</script>';
                        }
                        else {
                            $orderNum = "";
                        }
                    }

                    echo '<script>console.log("Sending values into tables of database!")</script>';
                    $queryThree = "INSERT INTO accounts (fname, lastName, email, password, phonenumber, address, aptOrSuite, state, city, zipCode, nameOnCard, cardNum, cardExp, cardCVV)
                                                 VALUES('$firstName','$lastName', '$email', '$password', '$phone', '$address', '$aptsuiteetc', '$state', '$city', '$zip','$cardname', '$cardnum', '$cardexp', '$cardcvv');";
                    $queryFour = "INSERT INTO orders (ordernum, email, contactinfo, deliveryinfo, paymentinfo) VALUES ('$orderNum', '$email', '$contact', '$delivery', '$payment');";

                    $resultThree = mysqli_query($conn, $queryThree);
                    $resultFour = mysqli_query($conn, $queryFour);

                    if($resultThree) {
                        echo '<script>console.log("Account created!")</script>';
                        $_SESSION['login'] = true;
                    }
                    else {
                        echo 'failed account';
                    }

                    if($resultFour) {
                        echo '<script>console.log("Order sent!")</script>';
                        header('Location: orderconf.php');
                    }
                }
                else {
                    echo '<script>alert("User exists! Please log in.")</script>';
                    header('Location: login.php');
                }
            }
            else {
                echo '<script>alert("Passwords do not match!")</script>';
                header('Refresh: 0');
            }
        }
        else if(!$createAccount && $formSuccess) {
           //Checking unique email
           $query = "SELECT * FROM accounts WHERE email='$email'";
           $result = mysqli_query($conn, $query);
           $rows = mysqli_num_rows($result);

           if($rows == 0) {
               echo '<script>console.log("Unique user check passed!")</script>';
               //Generating random order number
               $orderNumTaken = true;
               $orderNum = "";

               while($orderNumTaken) {

                   for($x= 0; $x <= 20; $x ++) {
                       $orderNum .= rand(0, 9);
                   }

                   $queryTwo = "SELECT * FROM orders WHERE ordernum='$orderNum'";
                   $resultTwo = mysqli_query($conn, $queryTwo);
                   $rowsTwo = mysqli_num_rows($resultTwo);

                   if($rowsTwo == 0) {
                       $orderNumTaken = false;
                       echo '<script>console.log("Order number generated")</script>';
                   }
                   else {
                       $orderNum = "";
                   }
               }

               echo '<script>console.log("Sending values into table of database!")</script>';
               $queryThree = "INSERT INTO orders (ordernum, email, contactinfo, deliveryinfo, paymentinfo) VALUES ('$orderNum', '$email', '$contact', '$delivery', '$payment');";
               $resultThree = mysqli_query($conn, $queryThree);

               if($resultThree) {
                   echo '<script>console.log("Order sent!")</script>';
                   header('Location: orderconf.php');
               }
           }
           else {
               echo '<script>alert("User exists! Please log in.")</script>';
               header('Location: login.php');
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
        <div class="checkoutContainer">
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
                    <form action="checkout.php" method="post" class="guestForm">
                        <script>console.log("User is logged out.")</script>
                        <div class="contact">
                            <h2>Contact Information</h2>

                            <input type="text" name="firstName" class="" placeholder="First Name">
                            <input type="text" name="lastName" class="" placeholder="Last Name"><br>
                            <input type="text" name="email" class="" placeholder="Email Address"><br>
                            <input type="text" name="phone" class="" placeholder="Phone Number"><br>
                            <label class=""><input type="checkbox" id="check" name="createaccount" class="" onclick="validate()">Create Account?</label><br>
                            <input type="password" id="password" name="password" class="passCreation" placeholder="Password"><br>
                            <input type="password" id="retypepass" name="retypepass" class="passCreation" placeholder="Confirm Password"><br>

                        </div>

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
                        
                        <div class="delivery">
                            <h2>Delivery Information</h2>
                            <input type="text" name="address" class="" placeholder="Street Address"><br>
                            <input type="text" name="aptsuiteunit" class="" placeholder="Apt, suite, etc. (optional)"><br>
                            <input type="text" name="state" class="" placeholder="State">
                            <input type="text" name="city" class="" placeholder="City">
                            <input type="text" name="zip" class="" placeholder="ZIP"><br>
                        </div>
                        
                        <div class="payment">
                            <h2>Payment Information</h2>
                            <input type="text" name="cardname" placeholder="Name On Card"><br>
                            <input type="text" name="cardnum" placeholder="Card Number">
                            <input type="text" name="cardexp" placeholder="Exp MM/YY">
                            <input type="text" name="cardcvv" placeholder="Enter CVV"><br>
                            <button type="submit" name="checkoutsubmit">Submit Payment</button>
                        </div>
                    </form>
                <?php } ?> 
            </div>

            <div class="cartInCheckOut">
                <div class="cart">
                    <h2>Cart</h2>
                </div>
            </div>
        </div>
    </body>
</html>