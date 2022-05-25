<?php

include_once("dbconnect.php");

if (isset($_GET['submit'])) {
    $operation = $_GET['submit'];
    if ($operation == 'delete') {
        $userid = $_GET['userid'];
        $sqldeleteuser = "DELETE FROM `tbl_user` WHERE user_id = '$userid'";
        $conn->exec($sqldeleteuser);
        echo "<script>alert('User deleted')</script>";
    }
    if ($operation == 'search') {
        $search = $_GET['search'];
        $option = $_GET['option'];
        if ($option == "Select"){
            $sqluser = "SELECT * FROM tbl_user WHERE user_name LIKE '%$search%'";
        }else{
            $sqluser = "SELECT * FROM tbl_user WHERE user_email = '$option'";
        }
    }else {
        $sqluser = "SELECT * FROM tbl_user";
    }
}
    
if (!isset($sqluser)) {
    $sqluser = "SELECT * FROM tbl_user";
}
$stmt = $conn->prepare($sqluser);
$stmt->execute();
$rows = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Welcome to My Tutor</title>
</head>

<body>
<div class="w3-purple">
        <div class="w3-container w3-center">
            <h3>User Lists</h3>
        </div>
    </div>
    <div class="w3-bar w3-purple">
        <a href="register.php" class="w3-bar-item w3-button w3-right">Register New User</a>
    </div>
    <div class="w3-bar w3-purple">
        <a href="login.php" class="w3-bar-item w3-button w3-right">Logout</a>
    </div>
    <div class="w3-margin w3-border w3-center" style="overflow-x:auto;">
        <?php
        $i = 0;
        echo "<table class='w3-table w3-striped w3-bordered' style='width:100%'>
         <tr><th style='width:5%'>No</th><th style='width:30%'>Name</th><th style='width:10%'>Email</th><th style='width:10%'>Phone Number(+60)</th><th style='width:40%'>Address</th>";
        foreach ($rows as $users) 
        {
            $i++;
            $userid = $users['user_id'];
            $username = $users['user_name'];
            $useremail = $users['user_email'];
            $userpassword = $users['user_password'];
            $userphone = $users['user_phone'];
            $useraddress = $users['user_address'];
           
            echo "<tr><td>$i</td><td>$username</td><td>$useremail</td><td>$userphone</td><td>$useraddress</td>
            <td><button class='btn'><a href='users.php?submit=delete&userid=$userid' class='fa fa-trash' onclick=\"return confirm('Are you sure?')\"></a></button></td>";
           
        }
        echo "</table>";
        ?>
    </div>
    <br>

    <footer class="w3-footer w3-center w3-bottom w3-purple">MY TUTOR COPYRIGHT</footer>

</body>

</html>