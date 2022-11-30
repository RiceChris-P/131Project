<?php
    session_start();
    $_SESSION["login"] = null;
    session_destroy();
    header('Location: ../index.php');
?>
<!DOCTYPE html>
<html>
    <p>Signed Out</p>
    <a href="../index.php">Back to home page</a>
</html>