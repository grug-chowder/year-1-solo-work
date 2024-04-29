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
</div>

<?php


    if(array_key_exists('Create_Employee', $_POST)) {
        $conn = new SQLite3('C:\xampp\htdocs\web_application\db\sqlite.db');
        $username = $_POST["Username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $passwordhashed = password_hash($password);

        
        $sql = "INSERT INTO User Table(UserName,UserEmail,PasswordHash,adminbool) VALUES('$username','$email','$passwordhashed',0)";
        
        if ($conn->query($sql) === TRUE) {
            echo "New account created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        }
    ?>
</body>
</body>
</html> 