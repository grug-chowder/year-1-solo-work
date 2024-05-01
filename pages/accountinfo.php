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
    <?php
    $db = new SQLite3('../db/db.db');
    $userid = $_SESSION["user_id"];

    $sql = "SELECT Transaction_Table.Ammount,Transaction_Table.time,Transaction_Table.convertion,User_table.UserName From Transaction_Table 
    Join Account_Table on Account_Table.AccountId = Transaction_Table.SenderId
    Join User_Table on User_Table.UserId = Account_Table.UserId
    Where ReciverId = $userid
    UNION
    SELECT Transaction_Table.Ammount,Transaction_Table.time,Transaction_Table.convertion,User_table.UserName From Transaction_Table 
    Join Account_Table on Account_Table.AccountId = Transaction_Table.ReciverId
    Join User_Table on User_Table.UserId = Account_Table.UserId
    Where SenderId = $userid
    ";

    $results = $db->query($sql);
    $result = $results->fetchArray();
    while($result != False){
      //echo "<p>".$result["Name"]."  ".$result["Ballance"]." ".$result["name"]."</p>";

      $result = $results->fetchArray();
    }

    ?>
  </div>

  <div class = "column right">
  <?php
    $sql = "SELECT Togbp,name From Currency where CurrencyId > 1";
    $results = $db->query($sql);
    $result = $results->fetchArray();
    while($result != False){
      echo "<p> gbp to ".$result["name"]."  1 - ".$result["Togbp"]."</p>";

      $result = $results->fetchArray();
    }

    ?>
  </div>
</div>

</body>
</html> 