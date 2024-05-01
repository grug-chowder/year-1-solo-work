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

    $sql = "SELECT AccountId From Account_Table Where UserId = $userid";
    $results = $db->query($sql);
    $result = $results->fetchArray();
    $accountid = "(";
    $accountid .= ($result["AccountId"]);
    $result = $results->fetchArray();
    while($result != False){
      $accountid .= (",".$result["AccountId"]);
      $result = $results->fetchArray();
    }
    $accountid .= ")";
    $sql = "SELECT * From Transaction_Table 
    Where ReciverId IN $accountid OR senderid IN $accountid
    ORDER by TIME DESC";

    $results = $db->query($sql);
    $result = $results->fetchArray();
    while($result != False){
      if($result["SenderId"] == $userid){
        echo "<p style='color:red;'> -".$result["Ammount"]." From Account Id ".$result["SenderId"]." To Account Id ".$result["ReciverId"]." at time ". date("Y-m-d\TH:i:s\Z",$result["time"])."</p>";
      } 
      else{
        echo "<p style='color:green;'> +".($result["Ammount"]*$result["convertion"])." From Account Id ".$result["SenderId"]." To Account Id ".$result["ReciverId"]." at time ". date("Y-m-d\TH:i:s\Z",$result["time"])."</p>";
      }

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