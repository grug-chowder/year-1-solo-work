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
?>

<div class = "login_box">
<h3>Login</h3>
  <form method="post">
      <div>
          <label>Username</label>
          <input type="text" name="Username" required>
      </div>
      </br>
      <div>
          <label>Password</label>
          <input type="text" name="password" required>
      </div>
      <input type="submit" value="Submit" name="Submit">
      </br>


      <?php
          if(array_key_exists('Submit', $_POST)) {
              $db = new SQLite3('../db/db.db');
              $username = $_POST["Username"];
              $password = $_POST["password"];

              $sql = "SELECT PasswordHash,UserId From User_Table where UserName = '$username'";

              $result = (($db->query($sql))->fetchArray());

              if($result != False){
                if(password_verify($password, $result["PasswordHash"]) == True){
                  session_start();
                  $_SESSION["user_id"] = $result["UserId"]
                  header("Location: mainpage.php")
                  exit();
                }
                else{
                  echo "invalid password";
                }
              }
              else{
                echo "invalid username";
              }
          }
          ?>

  <a href="createuser.php" class = "button">Sign Up</a> 
</div>
</body>
</html> 