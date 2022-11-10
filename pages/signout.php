<?php
    session_start();
    $_SESSION["login"] = null;
    session_destroy();
?>
<html>
    <p>Signed Out</p>
    <a href="index.php">Back to home page</a>
</html>