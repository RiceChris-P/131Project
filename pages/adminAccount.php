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
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if($_POST['email']!=$inputtedEmail&&$_POST['email']!=null){
            $oldEmail=$inputtedEmail;
            $inputtedEmail=$_POST['email'];
            $sql="UPDATE accounts SET email='$inputtedEmail' WHERE email='$oldEmail'";
            $results=mysqli_query($conn,$sql);
        }
        updateSqlValue("fname",$_POST['firstName'],$inputtedEmail);
        updateSqlValue("lastName",$_POST['lastName'],$inputtedEmail);
        updateSqlValue("phone ",$_POST['phone'],$inputtedEmail);
        updateSqlValue("address",$_POST['address'],$inputtedEmail);
        updateSqlValue("aptOrSuite",$_POST['aptsuiteunit'],$inputtedEmail);
        updateSqlValue("state",$_POST['state'],$inputtedEmail);
        updateSqlValue("city",$_POST['city'],$inputtedEmail);
        updateSqlValue("zipCode",$_POST['zip'],$inputtedEmail);
        updateSqlValue("nameOnCard",$_POST['cardname'],$inputtedEmail);
        updateSqlValue("cardNum",$_POST['cardnumber'],$inputtedEmail);
        updateSqlValue("cardExp",$_POST['cardexpiration'],$inputtedEmail);
        updateSqlValue("cardCVV",$_POST['cardcvv'],$inputtedEmail);
    }
?>
<html>
    <form method="post">
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
<?php
    function updateSqlValue($variable,$newValue,$userEmail){
        $conn = mysqli_connect("localhost", "root", "", "cmpe131");
        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql="UPDATE accounts SET $variable='$newValue' WHERE email='$userEmail'";
        mysqli_query($conn,$sql);
        $conn->close();
    }
?>