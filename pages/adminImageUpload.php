<html>

<link rel="stylesheet" href="../style/admin.css">
    <link rel="stylesheet" href="../style/form.css">

    <h1 class="adminHeader">Adding New Item</h1>
    <h3 class="bio">Fill in all the required fields to add a new gorcery item to OFS</h3>

    <form action="addItemToDatabase.php" method="post" enctype="multipart/form-data">

    <label class= "userLabel" for="0">Item Name</label><br>
    <input class="userField" type="text" name="itemName"required><br>

    <label class= "userLabel" for="0">Price</label><br>
    <input class="userField" type="text" name="price" onkeypress="return isNumberKey(event,this)" required><br>

    <label class= "userLabel" for="0">Weight</label><br>
    <input class="userField" type="text" name="weight" onkeypress="return isNumberKey(event,this)" required><br>

    <label class= "userLabel" for="0">Item Type</label><br>
    <select class="userField" name="itemType" ><br>
    <option class="userField" value="dairy">Dairy</option>
    <option class="userField" value="seafood">Seafood</option>
    <option class="userField" value="meat">Meat</option>
    <option class="userField" value="vegetable">Vegetable</option>
    <option class="userField" value="fruit">Fruit</option>
    </select>
    <!-- <input tpye="text" id="4"name="itemType" required> -->
    <br>
    <label class= "userLabel" for="0">Number of Items</label><br>
    <input class="userField" type="text" id="5" name="numOfItems" onkeypress="return isWholeNumberKey(event,this)" required ><br>
    <label class= "userLabel" for="0">Upload a new Picture</label><br>
    <input class="userField" type="file" name="file" required>
    <input type="hidden" name="oldItemName" value="<?php echo $chosenItem?>">
    <br><br>
    <input class="updateInfoButton" type="submit" name="submit" value="Submit">
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