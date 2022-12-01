<html>
    <form action="addItemToDatabase.php" method="post" enctype="multipart/form-data">
    <input type="text" name="itemName"required>
    <input type="text" name="price" onkeypress="return isNumberKey(event,this)" required>
    <input type="text" name="weight" onkeypress="return isNumberKey(event,this)" required>
    <select name="itemType" >
    <option value="dairy">Dairy</option>
    <option value="seafood">Seafood</option>
    <option value="meat">Meat</option>
    <option value="vegetable">Vegetable</option>
    <option value="fruit">Fruit</option>
    </select>
    <!-- <input tpye="text" id="4"name="itemType" required> -->
    <input type="text" id="5" name="numOfItems" onkeypress="return isWholeNumberKey(event,this)" required >
    Upload New Picture:
    <input type="file" name="file" required>
    <input type="hidden" name="oldItemName" value="<?php echo $chosenItem?>">
    <input type="submit" name="submit" value="Submit">
    </form>
</html>
<script>
    function isNumberKey(evt, txt) {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode == 46) {
        //Check if the text already contains the . character
        if (txt.value.indexOf('.') === -1) {
          return true;
        } else {
          return false;
        }
      } else {
        if (charCode > 31 &&
          (charCode < 48 || charCode > 57))
          return false;
      }
      return true;
    }
    function isWholeNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
    }
</script>