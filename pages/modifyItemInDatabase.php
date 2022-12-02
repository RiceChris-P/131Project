<?php
    session_start();
    if(!$_SESSION['admin']){
        header('Location: admin.php');
    }
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
    <head>
      <title>Admin Modifying Item</title>
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

    <h1 class="adminHeader"> Modifying Item...</h1>
    <form action="modifyItemProcessing.php" method="post" enctype="multipart/form-data"><br>

    <label class= "userLabel" for="0">Item Name</label><br>
    <input class="userField" type="text" id="0"name="itemName"required><br>
    <label class= "userLabel" for="0">Price (in dollars)</label>
    <br>
    <input class="userField" type="text" id="1" name="price" onkeypress="return isNumberKey(event,this)" required>
    <br>
    <label class= "userLabel" for="0">Weight</label>
    <br>
    <input class="userField" type="text" id="2" name="weight" onkeypress="return isNumberKey(event,this)" required>
    <br>
    <!-- <select name="itemType" >
    <option value="dairy">Dairy</option>
    <option value="seafood">Seafood</option>
    <option value="meat">Meat</option>
    <option value="vegetable">Vegetable</option>
    <option value="fruit">Fruit</option>
    </select> -->
    <label class= "userLabel" for="0">Item Type</label><br>
    <input class="userField" type="text" id="4"name="itemType" required>
    <br>
    <label class= "userLabel" for="0">Number of Items</label><br>
    <input class="userField" type="text" id="5" name="numOfItems" onkeypress="return isWholeNumberKey(event,this)" required >
    <br>
    <label class= "userLabel" for="0">Upload New Picture</label><br>
    <input class="userField"  type="file" name="file">
    <br>

    <input type="hidden" name="oldItemName" value="<?php echo $chosenItem?>">
    <br><br>
    <input class="updateInfoButton"  type="submit" name="submit" value="Submit">
    <br><br><br>
    <input class="updateInfoButton"  type="submit" name="delete" value="Delete Item">


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