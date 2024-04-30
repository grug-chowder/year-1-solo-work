<!DOCTYPE html>
<html lang="en">
<head>
<title>Page Title</title>
<link rel="stylesheet" href="../css/thecss.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}
</style>
</head>
<body>

<?php
include '../assets/headerbar.php';
include '../functions/redirect.php'
?>


<div class = "login_box">
<h3>New Account</h3>


<form method="post">
    <div>
        <label>Account Name</label>
        <input type="text" name="name" required>
    </div>
    </br>
    <div>
        <label>Currency</label>
        <input type="text" name="currency" required>
    </div>
    </br>
 


    <?php
        if(array_key_exists('Submit', $_POST)) {
            $db = new SQLite3('../db/db.db');
            $name = $_POST["name"];
            $currency = $_POST["currency"];
            
            $sql = "INSERT INTO Account_Table(Ballance,CurrencyId,UserId,Name) VALUES(0.00,(SELECT CurrencyId from Currency where name = '$currency'),'$_SESSION["user_id"]','$name')";
            
            if ($db->query($sql) != False) {
                header("Location: mainpage.php");
                exit();
            } 
            else{
                echo "invalid bucko try again mayhaps";
            }
        }
        ?>
</div>
</body>
</body>
</html> 