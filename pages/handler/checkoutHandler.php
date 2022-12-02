<?php
    use PHPMailer\PHPmailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    //Session
    $_SESSION['ordernum'] = NULL;
    $_SESSION['ordertotal'] = NULL;
    $_SESSION['email'] = NULL;
    $_SESSION['orderdate'] = NULL;
    $_SESSION['expecteddelivery'] = NULL;

    function updateStock($conn, $items) {
        $itemsarr = json_decode($items, true);

        for($x = 0; $x < count($itemsarr); $x ++) {
            $productID = $itemsarr[$x]["prod"]["Name"];
            $count = $itemsarr[$x]["count"];
            $getStockObject = mysqli_query($conn, "SELECT Stock FROM items WHERE Name='$productID';");
            $stockArray = mysqli_fetch_row($getStockObject);
            $stock = $stockArray[0];
            $newStock = $stock - $count;
            mysqli_query($conn, "UPDATE items SET Stock=$newStock WHERE Name='$productID';");
        }
    }

    function calculateCartPrices($cart) {
        $totalcost = 0;
        $totalweight = 0;
        $weightfee = 0;
        $subtotal = 0;
        $cartarr = json_decode($cart, true);

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

    function sendOrder($conn, $email, $password, $createPass, $items, $contact, $delivery, $payment) {
        //Get Price Calculations
        $cartStatArr = calculateCartPrices($items);

        //Set Price Calculation Variables
        $subtotal = $cartStatArr['subtotal'];
        $totalweight = $cartStatArr['totalweight'];
        $weightfee = $cartStatArr['weightfee'];
        $totalcost = $cartStatArr['totalcost'];

        //Create Account
        if($createPass) {
            createAccount($conn, $items, $email, $password, $contact, $payment, $delivery);
        }

        //Order email
        $_SESSION['email'] = $email;

        //Order Number
        $ordernum = getOrderNum($conn);
        $_SESSION['ordernum'] = $ordernum;

        //Order Date
        $date = date('m/d/Y');
        $_SESSION['orderdate'] = $date;

        //Order Expected Delivery Date
        $_SESSION['expecteddelivery'] = date('m/d/Y', strtotime('+3 days'));

        //Order total cost
        $_SESSION['ordertotal'] = $totalcost;

        //Sending Order
        mysqli_query(
            $conn,
            "INSERT INTO orders (ordernum, items, subtotal, totalweight, weightfee, totalcost, email, contactinfo, deliveryinfo, paymentinfo, orderdate) 
            VALUES ('$ordernum', '$items', '$subtotal', '$totalweight', '$weightfee', '$totalcost', '$email','$contact', '$delivery', '$payment', '$date');"
        );

        //Update Stock
        updateStock($conn, $items);
        
        //Sending Email
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ofsapp23@gmail.com';
        $mail->Password = 'uuqwlnckgwvixzup';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('ofsapp23@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Order number #".$ordernum." ";
        $delivery= date('m/d/Y', strtotime('+3 days'));
         $mail->Body ="<h1>Thank You for ordering from OFS!</h1>
                <table>
                    <thead>
                    <tr>
                        <th>ORDER NUMBER: $ordernum</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h3>Order total:</h3>
                                <h3>Order date:</h3>
                                <h3>Delivery date:</h3>
                            </td>
                            <td>
                               <h3> $".number_format($_SESSION['ordertotal'], 2, '.')."</h3>
                                <h3> $date</h3>
                                <h3> $delivery</h3>
                            </td>
                        </tr>

                    </tbody>
                </table>
        ";
        $mail->send();

        //Resetting Cart
        $newCart = json_encode (new stdClass);
        mysqli_query($conn, "UPDATE accounts SET cart = '$newCart' WHERE email = '$email';");
        return $totalcost;
    }

    function sendOrder2($conn, $isLogin, $email, $items, $contact, $delivery, $payment) {
        //Get Price Calculations
        $cartStatArr = calculateCartPrices($items);

        //Set Price Calculation Variables
        $subtotal = $cartStatArr['subtotal'];
        $totalweight = $cartStatArr['totalweight'];
        $weightfee = $cartStatArr['weightfee'];
        $totalcost = $cartStatArr['totalcost'];
        
        updateAccountLoggedIn();

        //Order email
        $_SESSION['email'] = $email;

        //Order Number
        $ordernum = getOrderNum($conn);
        $_SESSION['ordernum'] = $ordernum;

        //Order Date
        $date = date('m/d/Y');
        $_SESSION['orderdate'] = $date;

        //Order Expected Delivery Date
        $_SESSION['expecteddelivery'] = date('m/d/Y', strtotime('+3 days'));

        //Order total cost
        $_SESSION['ordertotal'] = $totalcost;

        //Sending Order
        mysqli_query(
            $conn,
            "INSERT INTO orders (ordernum, items, subtotal, totalweight, weightfee, totalcost, email, contactinfo, deliveryinfo, paymentinfo, orderdate) 
            VALUES ('$ordernum', '$items', '$subtotal', '$totalweight', '$weightfee', '$totalcost', '$email','$contact', '$delivery', '$payment', '$date');"
        );

        //Update Stock
        updateStock($conn, $items);

        //Sending Email
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ofsapp23@gmail.com';
        $mail->Password = 'uuqwlnckgwvixzup';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('ofsapp23@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Order number #".$ordernum." ";
        $delivery= date('m/d/Y', strtotime('+3 days'));
       $mail->Body = "<h1>Thank You for ordering from OFS!</h1>
        <table>
            <thead>
            <tr>
                <th>ORDER NUMBER: $ordernum</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <h3>Order total:</h3>
                    <h3>Order date:</h3>
                    <h3>Delivery date:</h3>
                </td>
                <td>
                    <h3> $".number_format($_SESSION['ordertotal'], 2, '.')."</h3>
                    <h3> $date</h3>
                    <h3> $delivery</h3>
                </td>
            </tr>

            </tbody>
        </table>
        ";
        $mail->send();

        //Resetting Cart
        $newCart = json_encode (new stdClass);
        mysqli_query($conn, "UPDATE accounts SET cart = '$newCart' WHERE email = '$email';");
        return $totalcost;
    }

    function updateAccountLoggedIn() {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {throw new Exception("Error Processing Request", 1);
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
        if($_POST['cardnum']) {
            updateSqlValue("cardNum",$_POST['cardnum']);
        }
        if($_POST['cardexp']) {
            updateSqlValue("cardExp",$_POST['cardexp']);
        }
        if($_POST['cardcvv']) {
            updateSqlValue("cardCVV",$_POST['cardcvv']);
        }
    }

    function updateAccount($conn, $email, $contact, $payment, $delivery) {
        //Getting array from JSON object
        $contactArr = json_decode($contact, true);
        $deliveryArr = json_decode($delivery, true);
        $paymentArr = json_decode($payment, true);

        //Inserting Account Info
        $fname = $contactArr['firstName'];
        $lname = $contactArr['lastName'];
        $contactPhone = $contactArr['phone'];

        $addy = $deliveryArr['address'];
        $apt = $deliveryArr['aptsuiteetc'];
        $deliveryState = $deliveryArr['state'];
        $deliveryCity = $deliveryArr['city'];
        $deliveryZip = $deliveryArr['zip'];

        $paycardname = $paymentArr['cardname'];
        $paycardnum = $paymentArr['cardnumber'];
        $paycardexp = $paymentArr['cardexpdate'];
        $paycardcvv = $paymentArr['cardcvv'];

        mysqli_query(
            $conn,
            "UPDATE accounts SET fname = '$fname', lastName = '$lname', phonenumber = '$contactPhone', 
            address = '$addy', aptOrSuite = '$apt', state = '$deliveryState', city = '$deliveryCity', zipCode = '$deliveryZip', 
            nameOnCard = '$paycardname', cardNum = '$paycardnum', cardExp = '$paycardexp', cardCVV = '$paycardcvv'
            WHERE email='$email';"
        );
    }

    function createAccount($conn, $items, $email, $password, $contact, $payment, $delivery) {
        //Create Account
        mysqli_query($conn, "INSERT INTO accounts (email, password, cart) VALUES ('$email', '$password', '$items')");
        $_SESSION['login'] = $email;

        //Updating Account Info
        updateAccount($conn, $email, $contact, $payment, $delivery);
    }

    function getOrderNum($conn) {
        $orderNumTaken = true;
        $orderNum = "";

        while($orderNumTaken) {
            for($x= 0; $x <= 20; $x ++) {
                $orderNum .= rand(0, 9);
            }

            $result = mysqli_query($conn, "SELECT * FROM orders WHERE ordernum='$orderNum'");

            if(mysqli_num_rows($result) == 0) {
                $orderNumTaken = false;
                return $orderNum;
            }
            else {
                   $orderNum = "";
            }
        }
    }

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
