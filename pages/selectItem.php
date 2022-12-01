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

<link rel="stylesheet" href="../style/admin.css">
<link rel="stylesheet" href="../style/form.css">
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