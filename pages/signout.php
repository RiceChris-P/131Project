<?php
    session_start();
    $_SESSION["login"] = null;
    session_destroy();
    header('Location: ../index.php');
?>