<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputtedEmail=$_POST['origSelectedEmail'];
        if($_POST['email']!=$_POST['origSelectedEmail']&&$_POST['email']!=null){
            $newEmail=$_POST['email'];
            $inputtedEmail=$_POST['email'];
            $sql="UPDATE accounts SET email=$newEmail WHERE email='$inputtedEmail'";
            $results=mysqli_query($conn,$sql);
        }
        updateSqlValue("fname",$_POST['firstName'],$inputtedEmail);
        updateSqlValue("lastName",$_POST['lastName'],$inputtedEmail);
        updateSqlValue("password",$_POST['password'],$inputtedEmail);
        updateSqlValue("phonenumber ",$_POST['phone'],$inputtedEmail);
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
<html>
    <form method="post" id="sendEmail" action="adminAccount.php">
        <input type="text" name="emails" id=0 value="<?php echo $_POST['emails']?>"></input>
    </form>
</html>
