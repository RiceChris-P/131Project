<?php
    $show = False;
    if(isset($_POST["username"]) && $_POST["username"] =="FrankButt" && $_POST["password"] == "fb123"){
        $show = True;
    }
?>
<html>
<link rel="stylesheet" href="../style/admin.css">
<link rel="stylesheet" href="../style/form.css">


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