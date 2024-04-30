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
<h3>New Employee</h3>


<form method="post">
    <div>
        <label>Username</label>
        <input type="text" name="Username" required>
    </div>
    </br>
    <div>
        <label>Email Adress</label>
        <input type="text" name="email" required>
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
            $email = $_POST["email"];
            $password = $_POST["password"];

            $passwordhashed = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO User_Table(UserName,UserEmail,PasswordHash,adminbool) VALUES('$username','$email','$passwordhashed',0)";
            
            if ($db->query($sql) != False) {
                header("Location: login.php");
                echo "if you see this the redirect hasnt worked :(";
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