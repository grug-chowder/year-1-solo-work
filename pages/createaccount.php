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
session_start();
include '../assets/headerbar.php';
include '../functions/redirect.php'
?>


<div class = "row">


  <?php
  include '../assets/left_sidebar.php';
  ?>

  <div class = "column centre">
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
        <input type="submit" value="Create Account" name="Submit">
        </br>
    


        <?php
            if(array_key_exists('Submit', $_POST)) {
                $db = new SQLite3('../db/db.db');
                $name = $_POST["name"];
                $currency = $_POST["currency"];
                $userid = $_SESSION['user_id'];
                $sql = "SELECT CurrencyId from Currency where name = '$currency'";
                $thing = $db->query($sql);
                $currecyid = $thing->fetchArray();
                if ($currecyid != False) {
                    $currencyid = $currecyid["CurrencyId"];
                    $sql = "INSERT INTO Account_Table(Ballance,CurrencyId,UserId,Name) VALUES(0.00,$currencyid,'$userid','$name')";
                    if ($db->query($sql) != False) {
                        header("Location: mainpage.php");
                        exit();
                    } 
                    else{
                        echo "invalid bucko try again mayhaps";
                    }
                }
                else{
                    echo "incorrect bucko try again mayhaps";
                }
            }
            ?>
    </div>
    <div class = "column right">
  </div>
</div>
</body>
</html> 