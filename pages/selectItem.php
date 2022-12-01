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
    <form method="post" action="modifyItemInDatabase.php">
    <select name="chosenItem">
        <option value="">Select</option>
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
        <input type="submit" name="Submit" value="Select" />  
    </form>
</html>