<?php
    $_SESSION['cart'] = json_encode (new stdClass);
    $_SESSION['totalitemcost'] = 0;
    $_SESSION['totalweight'] = 0;
    $_SESSION['totalcost'] = 0;
    $_SESSION['weightfee'] = 0;
    $_SESSION['ordernum'] = "";
    $_SESSION['ordertotal'] = 0;
    $_SESSION['email'] = "";
    $_SESSION['orderdate'] = "";
    $_SESSION['expecteddelivery'] = "";
?>