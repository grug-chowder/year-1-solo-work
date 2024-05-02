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
    <h2>Delete User Account:</h2>
    <form method="post">
        <div>
            <label>If Your Sure Type DELETE And Submit</label>
            <input type="text" name="confirm" required>
        </div>
        </br>
        <input type="submit" value="Delete Account" name="Submit">
        </br>
    
    <?php
    $db = new SQLite3('../db/db.db');
    $confirm = $_POST["confirm"]
    $userid = $_SESSION["user_id"];
    
    if($confirm == "DELETE"){
        $sql = "UPDATE User_Table SET(UserName,UserEmail.PasswordHash) = 'DELETED' WHERE UserId  = $userid";
        if($db->query($sql)){
            $sql = "UPDATE Account_Table SET Name = 'DELETED',Ballance = 0,CurrencyId = 0,Name = 'DELETED' WHERE UserId = $userid";
            if($db->query($sql)){
                header("Location: login.php");
                exit();

            }
        }

    }
    else{
        echo"You Must Enter Delete Or The Process Will Not Run";
    }
    

    ?>
  </div>

  <div class = "column right">
  
    ?>
  </div>
</div>

</body>
</html> 