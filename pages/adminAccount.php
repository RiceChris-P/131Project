<?php
    $inputtedEmail=$_POST['emails'];
    $conn=mysqli_connect("localhost","root","","cmpe131");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql="SELECT * FROM accounts WHERE email='$inputtedEmail'";
    $results= mysqli_query($conn,$sql);
    $values=mysqli_fetch_row($results);
    $conn->close();
?>
<html>
    <form method="post" action="adminAccountProcessingPage.php">
        <label for="0">First Name</label><br>
        <input type="text" name="firstName" class="" id="0" placeholder="First Name">
        <input type="text" name="lastName" class="" id="1" placeholder="Last Name">
        <input type="text" name="email" class="" id="2"placeholder="Email Address">
        <input type="text" name="password" id="3">
        <input type="text" name="phone" class="" id="4" placeholder="Phone Number">
        <input type="text" name="address" class="" id="5" placeholder="Street Address">
        <input type="text" name="aptsuiteunit" id="6" class="" placeholder="Apt, suite, etc. (optional)">
        <input type="text" name="state" id="7" class="" placeholder="State">
        <input type="text" name="city" id="8" class="" placeholder="City">
        <input type="text" name="zip" id="9" class="" placeholder="ZIP">
        <input type="text" name="cardname" id="10" placeholder="Name On Card"><br>
        <input type="text" name="cardnumber" id="11" placeholder="Card Number">
        <input type="text" name="cardexpiration" id="12" placeholder="Exp MM/YY">
        <input type="text" name="cardcvv" id="13"placeholder="Enter CVV"><br>
        <input type="hidden" name="origSelectedEmail" value="<?php echo $inputtedEmail?>">
        <button type="submit" name="updateAccount">Update Information</button>
    </form>
</html>
<script>
    var accountValues=<?php echo json_encode($values);?>;
    for(let i=0;i<accountValues.length;i++){
        if(accountValues[i]!=null){
            document.getElementById(i).value=accountValues[i];
        }
    }
</script>
