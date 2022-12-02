<?php
    session_start();
    if(!$_SESSION['admin']){
        header('Location: admin.php');
    }
    $conn=mysqli_connect("localhost","root", "","cmpe131");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql="SELECT * FROM accounts";
    $results= mysqli_query($conn,$sql);
    $conn->close();
?>
<!DOCTYPE html>
<html>
<header>
        <title>Admin Select Users</title>
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

    <h1 class="adminHeader">Select User</h1>

    <h3 class="bio"> Click the drowpdown to reveal current users shopping at OFS</h3>
    
    <form class="dropdown" method="post" action="adminAccount.php" style="margin: auto">
        <select class="mainboxselectUser" name="emails" required>
            <option value="">Select User</option>
            <?php
				//Loop through sql data to display
				while($rows=$results->fetch_assoc())
				{
			?>
                    <option value="<?php echo $rows['email']; ?>">  
                                         <?php echo $rows['email'];?>  
                    </option>  
                <?php  
                }  
                ?>  
        </select>  
        <input class="selectButton" type="submit" name="Submit" value="Select" />  
    </form>
</html>