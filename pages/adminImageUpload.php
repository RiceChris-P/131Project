<html>
    <form action="addItemToDatabase.php" method="post" enctype="multipart/form-data">
    <input type="text" name="itemName"required>
    <input type="text" name="price" required>
    <input type="text" name="weight" required>
    <select name="itemType" >
    <option value="dairy">Dairy</option>
    <option value="seafood">Seafood</option>
    <option value="meat">Meat</option>
    <option value="vegetable">Vegetable</option>
    <option value="fruit">Fruit</option>
    </select>
    <!-- <input tpye="text" name="itemType" required> -->
    <input type="text" name="numOfItems" required>
    Select Image File to Upload:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
    </form>
</html>
