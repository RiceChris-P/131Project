<!DOCTYPE html>

<?php
    include("navbar.php");
    include("handler/setCartSession.php");

    $arr = json_decode($_SESSION['cart'], true);
    $empty = empty($arr);

    if($empty) {
        header('Location: shop.php');
    }

    function calculateCartPrices() {
        $totalcost = 0;
        $totalweight = 0;
        $weightfee = 0;
        $subtotal = 0;
        $cartarr = json_decode($_SESSION['cart'], true);

        for($x = 0; $x < count($cartarr); $x ++) {
            $subtotal += (((double) $cartarr[$x]["prod"]["Price"]) * ((double) $cartarr[$x]["count"]));
            $totalweight += (((double) $cartarr[$x]["prod"]["Weight"]) * ((double) $cartarr[$x]["count"]));
        }

        if($totalweight >= 20) {
            $weightfee += (double) 5;
        }

        $totalcost = $subtotal + $weightfee;

        $priceArray = array(
            "subtotal" => (double) $subtotal,
            "totalweight" => (double) $totalweight,
            "weightfee" => (double) $weightfee,
            "totalcost" => (double) $totalcost,
        );

        return $priceArray;
    }

    function itemDisplay($name, $price, $weight, $image, $quantity) {
        echo <<<HTML
            <div class="cartCheckOutItem">
                <div class="cartCheckoutItemIMGContainer">
                    <img src="../itemImages/$image" alt="" class="cartCheckOutItemIMG">
                </div>
                <div class="cartCheckOutItemDesc">
                    <h3>$name</h3>
                    <p>
                        Quantity: $quantity <br>
                        Price: $$price <br>
                        Weight: $weight lbs<br>
                    </p>
                </div>
            </div>
        HTML;
    }

    function costStats($tic, $tw, $wf, $tc) {
        echo <<<HTML
            <div class="cartCheckOutCosts">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h3>Total Weight</h3>
                                <p>$tw lbs</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Subtotal</h3>
                                <p>$$tic</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Weight Fee</h3>
                                <p>$$wf</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Total</h3>
                                <p>$$tc</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        HTML;
    }

    function displayCartPrices() {
        $statArray = calculateCartPrices();

        $cartarr = json_decode($_SESSION['cart'], true);

        for($x = 0; $x < count($cartarr); $x ++) {
            $n = $cartarr[$x]["prod"]["Name"];
            $p = $cartarr[$x]["prod"]["Price"];
            $w = $cartarr[$x]["prod"]["Weight"];
            $i = $cartarr[$x]["prod"]["Image"];
            $t = $cartarr[$x]["prod"]["Type"];
            $q = $cartarr[$x]["count"];

            itemDisplay($n, $p, $w, $i, $q);
        }

        costStats($statArray['subtotal'], $statArray['totalweight'], $statArray['weightfee'], $statArray['totalcost']);
    }

    function getFill() {
        $conn = mysqli_connect("localhost", "root", "", "cmpe131");

        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        else {
            echo '<script>console.log("Connection Successful!")</script>';
        }

        $id = $_SESSION['login'];
        $getValues = "SELECT * FROM accounts WHERE email='$id'";
        $valSQL = mysqli_query($conn, $getValues); 
        $valArray = mysqli_fetch_row($valSQL);

        //Contact
        $contactFilled = true;

        //Delivery
        $deliveryFilled = false;

        $address = $valArray[5]; 
        $state = $valArray[7]; 
        $city = $valArray[8]; 
        $zip = $valArray[9];

        if($address != null and $state != null and $city != null and $zip != null) {
            $deliveryFilled = true;
        }

        //Payment
        $paymentFilled = false;

        $cardname = $valArray[10];
        $cardnum = $valArray[11];
        $cardexp = $valArray[12];
        $cardcvv = $valArray[13];

        if($cardname != null and $cardnum != null and $cardexp != null and $cardcvv != null) {
            $paymentFilled = true;
        }

        return array(
            "contact" => $contactFilled,
            "delivery" => $deliveryFilled,
            "payment" => $paymentFilled,
        );
    }

    $conn = mysqli_connect("localhost", "root", "", "cmpe131");

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    else {
        echo '<script>console.log("Connection Successful!")</script>';
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo '<script>console.log("POST Request Found!")</script>';

        //MySQL Work
        $id;
        $valArray;

        //Contact
        $contactFilled = false;
        $contactInfo = false;
        $firstName;
        $lastName;
        $email;
        $phone;

        //Create Account
        $createAccount = false;

        //Delivery
        $deliveryFilled = false;
        $deliveryInfo = false;
        $address;
        $aptsuiteetc; 
        $state; 
        $city; 
        $zip;

        //Payment
        $paymentFilled = false;
        $paymentInfo = false;
        $cardname;
        $cardnum;
        $cardexp;
        $cardcvv;

        if(isset($_SESSION['login'])) {
            $id = $_SESSION['login'];
            $getValues = "SELECT * FROM accounts WHERE email='$id'";
            $valSQL = mysqli_query($conn, $getValues); 
            $valArray = mysqli_fetch_row($valSQL);

            //Contact
            $contactFilled = true;
            $contactInfo = true;

            $firstName = $valArray[0];
            $lastName = $valArray[1]; 
            $email = $valArray[2];
            $phone = $valArray[4];

            //Delivery
            $address = $valArray[5]; 
            $aptsuiteetc = $valArray[6]; 
            $state = $valArray[7]; 
            $city = $valArray[8]; 
            $zip = $valArray[9];

            if($address != null and $state != null and $city != null and $zip != null) {
                $deliveryFilled = true;
                $deliveryInfo = true;
            }

            //Payment
            $cardname = $valArray[10];
            $cardnum = $valArray[11];
            $cardexp = $valArray[12];
            $cardcvv = $valArray[13];

            if($cardname != null and $cardnum != null and $cardexp != null and $cardcvv != null) {
                $paymentFilled = true;
                $paymentInfo = true;
            }
        }

        $formSuccess = false;
        $orderSuccess = false;

        if(!$contactFilled) {
             //Contact Info
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            //Create Accounts
            $password = $_POST['password'];
            $retypepass = $_POST['retypepass'];
        }

        //Delivery Info
        if(!$deliveryFilled) {
            $address = $_POST['address'];
            $aptsuiteetc = $_POST['aptsuiteunit'];
            $state = $_POST['state'];
            $city = $_POST['city'];
            $zip = $_POST['zip'];
        }

        //Payment Info
        if(!$paymentFilled) {
            $cardname = $_POST['cardname'];
            $cardnum = $_POST['cardnum'];
            $cardexp = $_POST['cardexp'];
            $cardcvv = $_POST['cardcvv'];
        }

        //Cart Stat Info
        $items = $_SESSION['cart'];
        $cartStatArr = calculateCartPrices();
        $subtotal = $cartStatArr['subtotal'];
        $totalweight = $cartStatArr['totalweight'];
        $weightfee = $cartStatArr['weightfee'];
        $totalcost = $cartStatArr['totalcost'];
        $_SESSION['subtotal'] = $subtotal;
        $_SESSION['totalweight'] = $totalweight;
        $_SESSION['totalcost'] = $totalcost;
        $_SESSION['weightfee'] = $weightfee;

        if(!$contactFilled) {
            if($firstName != null && $lastName != null && $email != null && $phone != null) {
                $passPhone = false;
                $passEmail = false;
    
                if(strlen($phone) == 10) {
                    $passPhone = true;
                }
    
                if(str_contains($email, '@') && str_contains($email, '.')) {
                    $passEmail = true;
                }
    
                if($passPhone && $passEmail) {
                    $contactInfo = true;
                }
            }
            // else {
            //     echo '<script>alert("Missing field input in contact info!")</script>';
            // }
    
            if($password != null && $retypepass != null) {
                $createAccount = true;
            }
        }

        if(!$deliveryFilled) {
            if($address != null && $state != null && $city != null && $zip != null) {
                $passState = false;
                $passZip = false;
    
                if(strlen($state) == 2) {
                    $passState = true;
                }
    
                if(strlen($zip) == 5) {
                    $passZip = true;
                }
    
                if($passState && $passZip) {
                    $deliveryInfo = true;
                }
            }
            // else {
            //     echo '<script>alert("Missing field input in delivery info!")</script>';
            // }
        }

        if(!$paymentFilled) {
            if($cardname != null && $cardnum != null && $cardexp != null && $cardcvv != null) {
                $passNum = false;
                $passExp = false;
                $passCVV = false;
                if(strlen($cardnum) == 15 or strlen($cardnum) == 16) {
                    $passNum = true;
                }
    
                if(strlen($cardcvv) == 3 or strlen($cardcvv) == 4) {
                    $passCVV = true;
                }
    
                if(strlen($cardexp) == 5) {
                    $passExp = true;
                }
    
                if($passCVV && $passNum && $passExp) {
                    $paymentInfo = true;
                }
            }
            // else {
            //     echo '<script>alert("Missing field input!")</script>';
            // }
        }

        if($contactInfo && $deliveryInfo && $paymentInfo) {
            $formSuccess = true;
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

                    $_SESSION['orderdate'] = date('m/d/Y');
                    $date = $_SESSION['orderdate'];

                    $queryThree = "INSERT INTO accounts (fname, lastName, email, password, phonenumber, address, aptOrSuite, state, city, zipCode, nameOnCard, cardNum, cardExp, cardCVV, cart)
                                                 VALUES('$firstName','$lastName', '$email', '$password', '$phone', '$address', '$aptsuiteetc', '$state', '$city', '$zip','$cardname', '$cardnum', '$cardexp', '$cardcvv', '$items');";
                    $queryFour = "INSERT INTO orders (ordernum, items, subtotal, totalweight, weightfee, totalcost, email, contactinfo, deliveryinfo, paymentinfo, orderdate) 
                                              VALUES ('$orderNum', '$items', '$subtotal', '$totalweight', '$weightfee', '$totalcost', '$email','$contact', '$delivery', '$payment', '$date');";

                    $resultThree = mysqli_query($conn, $queryThree);
                    $resultFour = mysqli_query($conn, $queryFour);

                    if($resultThree) {
                        echo '<script>console.log("Account created!")</script>';
                        $_SESSION['login'] = $email;
                    }

                    if($resultFour) {
                        echo '<script>console.log("Order sent!")</script>';
                        $_SESSION['ordernum'] = $orderNum;
                        $_SESSION['ordertotal'] = $totalcost;
                        $_SESSION['email'] = $email;
                        $_SESSION['orderdate'] = date('m/d/Y');
                        $_SESSION['expecteddelivery'] = date('m/d/Y', strtotime('+3 days'));

                        //Order Successful, so erases kept cart
                        $newCart = json_encode (new stdClass);
                        $queryFive = "UPDATE accounts SET cart = '$newCart' WHERE email = '$email';";
                        $resultFive = mysqli_query($conn, $queryFive);

                        //Checks if query is successful
                        if($resultFive) {
                            echo '<script>console.log("Cart updated!")</script>';
                        }

                        header('Location: order.php');
                    }
                }
                else {
                    echo '<script>alert("User exists! Please log in.")</script>';
                }
            }
            else {
                echo '<script>alert("Passwords do not match!")</script>';
            }
        }
        else if(!$createAccount && $formSuccess) {
           //Checking unique email
           $query = "SELECT * FROM accounts WHERE email='$email'";
           $result = mysqli_query($conn, $query);
           $rows = mysqli_num_rows($result);

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
                   $_SESSION['ordernum'] = $orderNum;
                   echo '<script>console.log("Order number generated")</script>';
               }
               else {
                   $orderNum = "";
               }
           }

           if($rows == 0) {
               echo '<script>console.log("Unique user check passed!")</script>';

               echo '<script>console.log("Sending values into table of database!")</script>';

               $_SESSION['orderdate'] = date('m/d/Y');
               $date = $_SESSION['orderdate'];

               $queryThree = "INSERT INTO orders (ordernum, items, subtotal, totalweight, weightfee, totalcost, email, contactinfo, deliveryinfo, paymentinfo, orderdate) 
                                          VALUES ('$orderNum', '$items', '$subtotal', '$totalweight', '$weightfee', '$totalcost', '$email','$contact', '$delivery', '$payment', '$date');";
               $resultThree = mysqli_query($conn, $queryThree);

               if($resultThree) {
                    echo '<script>console.log("Order sent!")</script>';
                    $_SESSION['ordernum'] = $orderNum;
                    $_SESSION['ordertotal'] = $totalcost;
                    $_SESSION['email'] = $email;
                    $_SESSION['orderdate'] = date('m/d/Y');
                    $_SESSION['expecteddelivery'] = date('m/d/Y', strtotime('+3 days'));

                    //Order Successful, so erases kept cart
                    $newCart = json_encode (new stdClass);
                    $queryFive = "UPDATE accounts SET cart = '$newCart' WHERE email = '$email';";
                    $resultFive = mysqli_query($conn, $queryFive);

                    //Checks if query is successful
                    if($resultFive) {
                        echo '<script>console.log("Cart updated!")</script>';
                    }
                        
                    header('Location: order.php');
               }
           }
           else {
               if(!isset($_SESSION['login'])) {
                    echo '<script>alert("User exists! Please log in.")</script>';
                    header('Location: login.php');
               }
               else {
                    echo '<script>console.log("Sending values into table of database!")</script>';
                    $_SESSION['orderdate'] = date('m/d/Y');
                    $date = $_SESSION['orderdate'];
                    $queryThree = "INSERT INTO orders (ordernum, items, subtotal, totalweight, weightfee, totalcost, email, contactinfo, deliveryinfo, paymentinfo, orderdate) 
                                                VALUES ('$orderNum', '$items', '$subtotal', '$totalweight', '$weightfee', '$totalcost', '$email','$contact', '$delivery', '$payment', '$date');";
                    $resultThree = mysqli_query($conn, $queryThree);

                    $id = $_SESSION['login'];

                    $updateDeliveryQuery = "UPDATE accounts
                                    SET
                                        address = '$address',
                                        aptOrSuite = '$aptsuiteetc',
                                        state = '$state',
                                        city = '$city',
                                        zipCode = '$zip'
                                    WHERE email = '$id';";
    
                    $updatePaymentQuery = "UPDATE accounts
                                    SET
                                        nameOnCard = '$cardname',
                                        cardNum = '$cardnum',
                                        cardExp = '$cardexp',
                                        cardCVV = '$cardcvv'
                                    WHERE email = '$id';";
    
                    if(!$deliveryFilled) {
                        $deliveryResult = mysqli_query($conn, $updateDeliveryQuery);
                        if($deliveryResult) {
                            echo '<script>console.log("Delivery Updated!")</script>';
                        }
                    }
    
                    if(!$paymentFilled) {
                        $paymentResult = mysqli_query($conn, $updatePaymentQuery);
                        if($paymentResult) {
                            echo '<script>console.log("Payment Updated!")</script>';
                        }
                    }

                    if($resultThree) {
                        echo '<script>console.log("Order sent!")</script>';
                        $_SESSION['ordernum'] = $orderNum;
                        $_SESSION['ordertotal'] = $totalcost;
                        $_SESSION['email'] = $email;
                        $_SESSION['expecteddelivery'] = date('m/d/Y', strtotime('+3 days'));

                        //Order Successful, so erases kept cart
                        $newCart = json_encode (new stdClass);
                        $queryFive = "UPDATE accounts SET cart = '$newCart' WHERE email = '$email';";
                        $resultFive = mysqli_query($conn, $queryFive);

                        //Checks if query is successful
                        if($resultFive) {
                            echo '<script>console.log("Cart updated!")</script>';
                        }
                            
                        header('Location: order.php');
                    }
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" href="../style/checkout.css">
    </head>

    <body>
        <div class="checkoutContainer">
            <div class="checkOutInfo">
                <?php 
                if(isset($_SESSION['login'])) { 
                    $arr = getFill();
                    $deliveryFilled = $arr['delivery'];
                    $paymentFilled = $arr['payment'];
                ?>
                    <form action="checkout.php" method="post" class="guestForm" onsubmit="return validateForm()">
                        
                        <?php 
                        if(!$deliveryFilled) {
                        ?>

                            <div class="delivery">
                                <h2>Delivery Information</h2>
                                <input type="text" name="address" id="address" class="" placeholder="Street Address"><br>
                                <input type="text" name="aptsuiteunit" id="aptsuiteunit" class="" placeholder="Apt, suite, etc. (optional)"><br>
                                <input type="text" name="state" id="state" class="" placeholder="State">
                                <input type="text" name="city" id="city" class="" placeholder="City">
                                <input type="text" name="zip" id="zip" class="" placeholder="ZIP"><br>

                                <?php 
                                if($paymentFilled) {
                                ?>

                                    <button type="submit" name="checkoutsubmit" id="checkoutsubmit">Submit Payment</button>

                                <?php } ?>
                            </div>

                        <?php } ?>

                        <?php 
                        if(!$paymentFilled) {
                        ?>

                            <div class="payment">
                                <h2>Payment Information</h2>
                                <input type="text" name="cardname" placeholder="Name On Card" id="cardname"><br>
                                <input type="text" name="cardnum" placeholder="Card Number" id="cardnum">
                                <input type="text" name="cardexp" placeholder="Exp MM/YY" id="cardexp">
                                <input type="text" name="cardcvv" placeholder="Enter CVV" id="cardcvv"><br>
                                <button type="submit" name="checkoutsubmit" id="checkoutsubmit">Submit Payment</button>
                            </div>

                        <?php } ?>

                        <?php 
                        if($deliveryFilled && $paymentFilled) {
                        ?>

                            <div class="payment">
                                <button type="submit" name="checkoutsubmit" id="checkoutsubmit">Submit Payment</button>
                            </div>

                        <?php } ?>

                    </form>
                <?php } else { ?>
                    <form action="checkout.php" method="post" class="guestForm" onsubmit="return validateForm()">
                        <script>console.log("User is logged out.")</script>
                        <div class="contact">
                            <h2>Contact Information</h2>

                            <input type="text" name="firstName" id="firstName" class="" placeholder="First Name">
                            <input type="text" name="lastName" id="lastName" class="" placeholder="Last Name"><br>
                            <input type="text" name="email" id="email" class="" placeholder="Email Address"><br>
                            <input type="text" name="phone" id="phone" class="" placeholder="Phone Number" onkeypress="return isNumberKey(event)"><br>
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
                            <input type="text" name="address" id="address" class="" placeholder="Street Address"><br>
                            <input type="text" name="aptsuiteunit" id="aptsuiteunit"class="" placeholder="Apt, suite, etc. (optional)"><br>
                            <input type="text" name="state" id="state" class="" placeholder="State">
                            <input type="text" name="city" id ="city" class="" placeholder="City">
                            <input type="text" name="zip" id="zip" class="" placeholder="ZIP" onkeypress="return isNumberKey(event)"><br>
                        </div>
                        
                        <div class="payment">
                            <h2>Payment Information</h2>
                            <input type="text" name="cardname" id="cardname" placeholder="Name On Card"><br>
                            <input type="text" name="cardnum" id="cardnum" placeholder="Card Number" onkeypress="return isNumberKey(event)">
                            <input type="text" name="cardexp" id="cardexp" placeholder="Exp MM/YY">
                            <input type="text" name="cardcvv" id="cardcvv" placeholder="Enter CVV" onkeypress="return isNumberKey(event)"><br>
                            <button type="submit" name="checkoutsubmit" id="checkoutsubmit">Submit Payment</button>
                        </div>
                    </form>
                <?php } ?> 
            </div>

            <div class="cartInCheckOut">
                <h2>Cart</h2>
                <div class="cartCheckout">
                    <div class="cartCheckOutItemContainer">
                        <?php displayCartPrices() ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>

        const submitButton = document.getElementById('checkoutsubmit');
        const firstname = document.querySelector('#firstName');
        const lastname = document.querySelector('#lastName');
        const email = document.querySelector('#email');
        const check = document.querySelector('#check');
        const password = document.querySelector('#password');
        const retypepass = document.querySelector('#retypepass');
        const phone = document.querySelector('#phone');
        const address = document.querySelector('#address');
        const state = document.querySelector('#state');
        const city = document.querySelector('#city');
        const zip = document.querySelector('#zip');
        const cardname = document.querySelector('#cardname');
        const cardnum = document.querySelector('#cardnum');
        const cardexp = document.querySelector('#cardexp');
        const cardcvv = document.querySelector('#cardcvv');

        function validateNotEmpty() {
            let success = true;

            if(firstname.value.length ===0) {
                firstname.style.border = '2px solid';
                firstname.style.borderColor = 'red';
                alert("First name cannot be empty.");
                success =  false;
            }
            if(lastname.value.length ===0) {
                lastname.style.border = '2px solid';
                lastname.style.borderColor = 'red';
                alert("Last name cannot be empty.");
                success =  false;
            }
            if(address.value.length ===0) {
                address.style.border = '2px solid';
                address.style.borderColor = 'red';
                alert("Address cannot be empty.");
                success =false;
            }
            if(city.value.length ===0) {
                city.style.border = '2px solid';
                city.style.borderColor = 'red';
                alert("City cannot be empty.");
                success = false;
            }
            if(cardname.value.length ===0) {
                cardname.style.border = '2px solid';
                cardname.style.borderColor = 'red';
                alert("Card name cannot be empty.");
                success = false;
            }
            return success;
        }

        function createAccountValidation() {
            let success = true;
            if(check.checked) {
                if(password.value.length === 0) {
                    password.style.border = '2px solid';
                    password.style.borderColor = 'red';
                    alert("Password cannot be empty.");
                    success = false;
                }
                if(retypepass.value.length === 0) {
                    retypepass.style.border = '2px solid';
                    retypepass.style.borderColor = 'red';
                    alert("Password cannot be empty.");
                    success = false;
                }
                if(!(password.value === retypepass.value)) {
                    password.style.border = '2px solid';
                    password.style.borderColor = 'red';
                    retypepass.style.border = '2px solid';
                    retypepass.style.borderColor = 'red';
                    alert("Passwords do not match.");
                    success = false;
                }
            }
            return success;
        }

        function emailValidation() {
            if(!email.value.includes('@') || !email.value.includes('.')) {
                email.style.border = '2px solid';
                email.style.borderColor = 'red';
                alert("Email must in format emailaddress@domain.com (e.g., user@gmail.com).")
                return false;
            }
            return true;
        }

        function phoneValidation() {
            if(phone.value.toString().length != 10) {
                phone.style.border = '2px solid';
                phone.style.borderColor = 'red';
                alert("Phone must be 10 digits (e.g., 4151231234).");
                return false;
            }
            return true;
        }

        function stateValidation() {
            if(state.value.length != 2) {
                state.style.border = '2px solid';
                state.style.borderColor = 'red';
                alert("State must its abbreviated (e.g., CA).");
                return false;
            }
            return true;
        }

        function zipValidation() {
            if(zip.value.toString().length != 5) {
                zip.style.border = '2px solid';
                zip.style.borderColor = 'red';
                alert("Zipcode must be 5 digits (e.g., 94134).");
                return false;
            }
            return true;
        }

        function cardNumValidation() {
            if(cardnum.value.toString().length != 15 && cardnum.value.toString().length != 16) {
                cardnum.style.border = '2px solid';
                cardnum.style.borderColor = 'red';
                alert("Card number must be 15 or 16 digits (e.g., 123456789012345 or 1234567890123456).");
                return false;
            }
            return true;
        }

        function cardExpValidation() {
            if(cardexp.value.length != 5) {
                cardexp.style.border = '2px solid';
                cardexp.style.borderColor = 'red';
                alert("Card expiration date must be in format MM/YY (e.g., 01/23).");
                return false;
            }
            return false;
        }

        function cardCVVValidation() {
            if(cardcvv.value.toString().length != 3 && cardnum.value.toString().length != 4) {
                cardcvv.style.border = '2px solid';
                cardcvv.style.borderColor = 'red';
                alert("Card CVV must be 3 or 4 digits (e.g., 123 or 1234).");
                return false;
            }
            return true;
        }

        function validateForm() {
            let success = false;
            success = validateNotEmpty();
            success = emailValidation();
            success = phoneValidation();  
            success = createAccountValidation();
            success = stateValidation();
            success = zipValidation();
            success = cardNumValidation();
            success = cardExpValidation();
            success = cardCVVValidation();
            return success;
        }

        submitButton.addEventListener('click', e => {
            let success = false;
            success = validateForm();
            if(!success) {
                e.preventDefault();
            }
        });

        function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
    </script>
</html>
