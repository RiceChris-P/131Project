<?php
    $show=false;
    session_start();
    if(isset($_POST["username"])&&isset($_POST['password']) && $_POST["username"] =="FrankButt" && $_POST["password"] == "fb123"){
        $_SESSION['admin']=true;
    }
    if(isset($_SESSION['admin'])&&$_SESSION['admin']){
        $show=true;
    }
    if(isset($_POST['status'])&&$_POST['status']==1){
        echo '<script>alert("success");</script>';
    }
?>
<html>
    <header>
        <title>Admin Sign Up</title>
        <link rel="stylesheet" href="../style/admin.css">
        <link rel="stylesheet" href="../style/form.css">
        <link rel="stylesheet" href="../style/form.css">
    </header>
    <body>
      <nav class="navBar">
        <ul>
            <div class="logoElement">
                <a href="../index.php"> <img class="logo" src="../assets/logo-transparent.png" alt=""> </a>
            </div>
        </ul>
      </nav>

    <h1 class="adminHeader">Admin Access</h1>

    <br>
    <br>
    <br>
    <?php 
    if($show) { 
    ?>
        <h3 class="successTitle">Success</h3>
        <button class= "adminOptions" onclick="location.href = 'selectItem.php';">Modify Items</button>
        <br>
        <button class="adminOptions" onclick="location.href = 'adminImageUpload.php';">Add Items</button>
        <br>
        <button class="adminOptions" onclick="location.href = 'adminHome.php';">View Accounts</button>
        <br>
        <button class="adminOptions" onclick="location.href = 'signout.php';">Signout</button>
        <br>
    <?php } else { ?>
      <form action="admin.php" method="post" class="formBox">
            <input type="text" name="username" class="loginFill" placeholder="Username"><br>
            <input type="password" name="password" class="loginFill" placeholder="Password"><br>
            <button type="submit" class="adminsubmitsignin">Sign In</button>
        </form>  
    <?php
    }
    ?>
</html>