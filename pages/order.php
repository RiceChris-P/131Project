<?php
    include("navbar.php");

    // if(!isSet($_SESSION['login']) or !isSet($_SESSION['ordernum'])){
    //     header('Location: index.php');
    // }

    $_SESSION['ordernum'] = "12345678901234567890";
    $_SESSION['ordertotal'] = 100.00; //Implement later
    $_SESSION['email'] = "test@gmail.com";
    $_SESSION['orderdate'] = date('m/d/Y');
    $_SESSION['expecteddelivery'] = date('m/d/Y', strtotime('+3 days'));
?>

<!DOCTYPE>
<html>
    <head>
        <title>Order Confirmation</title>
        <link rel="stylesheet" href="../style/order.css">
    </head>
    <body>
        <div class="container">
            <h1>Thank you for your order.</h1>
            <div class="orderInfo">
                <table>
                    <thead>
                    <tr>
                        <th>ORDER NUMBER:  
                        <?php
                            echo $_SESSION['ordernum'];
                        ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h4>Order total</h4>
                                <?php 
                                    echo "$" . number_format($_SESSION['ordertotal'], 2, '.');
                                ?>
                            </td>
                            <td>
                                <h4>Order date</h4>
                                <?php 
                                    echo $_SESSION['orderdate'];
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Email</h4>
                                <?php 
                                    echo $_SESSION['email'];
                                ?>
                            </td>
                            <td>
                                <h4>Expected delivery</h4>
                                <?php 
                                    echo $_SESSION['expecteddelivery'];
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button><a href="shop.php">Shop More</a></button>
        </div>
    </body>
</html>