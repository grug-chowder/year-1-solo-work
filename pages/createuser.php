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

<form action="" method="post">
    <div class="row gy-4 mt-1">
        


    <form method="post">
    <div class="form-outline mb-2">
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
    </br>
</div>

<?php


    if(array_key_exists('Create_Employee', $_POST)) {
        $conn = new SQLite3('C:\xampp\htdocs\web_application\db\sqlite.db');
        $username = $_POST["Username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $passwordhashed = password_hash($password);

        if ($verify == true) {
        $sql = "INSERT INTO employee(first_name,middle_name,last_name,email,telephone,pin_hash,username,password_hash,salt,job_id,department_id) VALUES('$first_name','$middle_name','$last_name','$email','$phone_num','$pin','$username','$password','$salt','$job_id','$dep_id')";
        
            if ($conn->query($sql) === TRUE) {
                echo "New employee created successfully";
            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else {
            echo "Invalid Input";
        }
    }

    ?>
</body>
</body>
</html> 