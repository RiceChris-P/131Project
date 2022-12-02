<?php
    $conn=mysqli_connect("localhost","root", "","cmpe131");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql="SELECT * FROM items";
    $results= mysqli_query($conn,$sql);
    $conn->close();
?>
<!DOCTYPE html>
<html>
<header>
        <title>Admin Modify Items</title>
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

<h1 class="adminHeader">Modify Items </h1>
<h3 class="bio"> Select a grocery item from the dropdown to change</h3>
    <form method="post" action="modifyItemInDatabase.php">
    <select class= "mainbox" name="chosenItem" required>
        <option value="">Select Item</option>
        <?php
				while($rows=$results->fetch_assoc())
				{
			?>
                    <option value="<?php echo $rows['Name']; ?>">  
                                         <?php echo $rows['Name'];?>  
                    </option>  
                <?php  
                }  
                ?>  
        </select>  
        <input class="selectButton" type="submit" name="Submit" value="Select" />  
    </form>
</html>