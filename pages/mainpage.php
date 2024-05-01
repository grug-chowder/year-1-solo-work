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
    <h2>Your Accounts:</h2>
    <?php
    $db = new SQLite3('../db/db.db');
    $userid = $_SESSION["user_id"];
    $sql = "SELECT Account_Table.Ballance,Account_Table.Name,Currency.name From Account_Table
    Join Currency On Account_Table.CurrencyId = Currency.CurrencyId 
    Where UserId = '$userid'";
    $results = $db->query($sql);
    $result = $results->fetchArray();
    while($result != False){
      echo "<p>".$result["Name"]."  ".$result["Ballance"]." ".$result["name"]."</p>";

      $result = $results->fetchArray();
    }

    ?>
  </div>

  <div class = "column right">
  <h3>Current Exchange Rates:</h3>
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