<?php
    $inputtedEmail=$_POST['emails'];
    $conn=mysqli_connect("localhost","root","","cmpe131");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql="SELECT * FROM accounts WHERE email='$inputtedEmail'";
    $results= mysqli_query($conn,$sql);
    $values=mysqli_fetch_row($results);
?>
<html>
    <form method="post">
        <label for="0">First Name</label><br>
        <input type="text" name="firstName" class="" id="0" placeholder="First Name">
        <input type="text" name="lastName" class="" id="1" placeholder="Last Name">
        <input type="text" name="email" class="" id="2"placeholder="Email Address">
        <input type="text" name="phone" class="" id="3" placeholder="Phone Number">
        <button type="submit" name="updateAccount">Update Information</button>
    </form>
</html>
<script>
    var accountValues=<?php echo json_encode($values);?>;
    for(let i=0;i<4;i++){
        if(accountValues[i]!=null){
            document.getElementById(i).value=accountValues[i];
        }
    }
</script>
