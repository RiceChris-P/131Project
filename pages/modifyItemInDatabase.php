<?php
    $chosenItem=$_POST['chosenItem'];
    $conn=mysqli_connect("localhost","root", "","cmpe131");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql="SELECT * FROM items WHERE Name='$chosenItem'";
    $results=mysqli_query($conn,$sql);
    $values=mysqli_fetch_row($results);
    $conn->close();

?>
<html>
    <form action="modifyItemProcessing.php" method="post" enctype="multipart/form-data">
    <input type="text" id="0"name="itemName"required>
    <input type="text" id="1" name="price" required>
    <input type="text" id="2" name="weight" required>
    <!-- <select name="itemType" >
    <option value="dairy">Dairy</option>
    <option value="seafood">Seafood</option>
    <option value="meat">Meat</option>
    <option value="vegetable">Vegetable</option>
    <option value="fruit">Fruit</option>
    </select> -->
    <input tpye="text" id="4"name="itemType" required>
    <input type="text" id="5" name="numOfItems" onkeypress="return isNumberKey(event)" required >
    Upload New Picture:
    <input type="file" name="file">
    <input type="hidden" name="oldItemName" value="<?php echo $chosenItem?>">
    <input type="submit" name="submit" value="Upload">
    </form>
</html>

<script>
    var itemDetails=<?php echo json_encode($values);?>;
    for(let i=0;i<itemDetails.length;i++){
        if(itemDetails[i]!=null){
            document.getElementById(i).value=itemDetails[i];
        }
        if(i==2){
            i++;
        }
    }
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>