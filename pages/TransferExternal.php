
<!DOCTYPE html>
<html lang="en">
<head>
<title>Page Title</title>
<link rel="stylesheet" href="../css/thecss.css">
<meta charset="UTF-8">
<meta name="viewport" content="initial-scale=1">
<style>

* {
  box-sizing: border-box;
}

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
        <label>Username Of Recipient</label>
        <input type="text" name="Username" required>
    </div>
    </br>
    <div>
        <label>AccountId Of Recipient</label>
        <input type="text" name="AccountId" required>
    </div>
    </br>
    <div>
        <label>AccountId Of Sender</label>
        <input type="text" name="AccountId" required>
    </div>
    </br>
    <div>
        <label>Amount</label>
        <input type="text" name="Amount" required>
    </div>
    </br>
    <div>
        <label>Your Password</label>
        <input type="text" name="Password" required>
    </div>
    <input type="submit" value="Confirm" name="Submit">
    </br>



    <?php
        if(array_key_exists('Submit', $_POST)) {
            $db = new SQLite3('../db/db.db');
            $accountid = $_POST["AccountId"];
            $amount = floatval($_POST["Amount"]);
            $password = $_POST["Password"];
            $userid = $_SESSION['user_id'];
            
            //verification
            $sql = "SELECT PasswordHash From User_Table Where UserId = $userid"
            
          }
            
            
            

        ?>
        
  </div>

  <div class = "column right">
  <?php
    ?>
  </div>
</div>

</body>
</html> 