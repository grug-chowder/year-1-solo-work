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

<div class = "column left">
  <a href="mainpage.php" class = "button">Main Page </a> 
  <a href="accountinfo.php" class = "button">Account Info </a> 
  <a href="TransferFunds.php" class = "button">Transfer Funds </a>
  <a href="TransferExternal.php" class = "button">Transfer External </a>
  <a href="createaccount.php" class = "button">Create Account</a>
  
  <?php
  $db = new SQLite3('../db/db.db');
  $userid = $_SESSION["user_id"];
  $sql = "SELECT adminbool from User_Table Where UserId = $userid";
  $results = $db->query($sql);
  $result = $results->fetchArray();
  if($result["adminbool"] == 1){
    echo"<a href='adminpage.php' class = 'button'>Admin page</a>"; 
  }
  $db->close();

  ?>
  <a href="logout.php" class = "button">logout</a> 


  </div>