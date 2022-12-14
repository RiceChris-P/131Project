<?php
    include("navbar.php");

    if(!isSet($_SESSION['login']) or !isSet($_SESSION['ordernum'])){
        header('Location: ../index.php');
    }
    
    function resetSession() {
        $_SESSION['ordernum'] = NULL;
        $_SESSION['ordertotal'] = NULL;
        $_SESSION['email'] = NULL;
        $_SESSION['orderdate'] = NULL;
        $_SESSION['expecteddelivery'] = NULL;
    }
?>

<!DOCTYPE html>
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
                                    $email = $_SESSION['email'];
                                    echo $email;
                                ?>
                            </td>
                            <td>
                                <h4>Expected delivery</h4>
                                <?php 
                                    echo $_SESSION['expecteddelivery'];
                                    resetSession();
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
