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
  <h2>List Of Suspicious Transactions:</h2>
    <?php
    $db = new SQLite3('../db/db.db');
    $userid = $_SESSION["user_id"];
    $sql = "SELECT User_Table.UserName,User_Table.UserEmail,Transaction_Table.SenderId,Transaction_Table.time From Transaction_Table
    Join Account_Table ON Account_Table.AccountId = Transaction_Table.SenderId
    Join User_Table ON User_Table.UserId = Account_Table.UserId
    Where Transaction_Table.Ammount >= 2000";

    $results = $db->query($sql);
    $result = $results->fetchArray();
    while($result != False){
      
      echo "<p>".$result["UserName"]." <br> Contact: ".$result["UserEmail"]." Time: ".$result["time"]."</p>";

      $result = $results->fetchArray();
      
    }
    ?>
  </div>

  <div class = "column right">
  </div>
</div>

</body>
</html> 