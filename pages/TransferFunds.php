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

    <form method="post">
    <div>
        <label>Username Of Recipient</label>
        <input type="text" name="Username" required>
    </div>
    </br>
    <div>
        <label>AccountId Of Recipient</label>
        <input type="text" name="AccountId" required>
    </div>
    </br>
    <div>
        <label>AccountId Of Sender</label>
        <input type="text" name="AccountIdSend" required>
    </div>
    </br>
    <div>
        <label>Amount</label>
        <input type="text" name="Amount" required>
    </div>
    </br>
    <div>
        <label>Your Password</label>
        <input type="text" name="Password" required>
    </div>
    <input type="submit" value="Confirm" name="Submit">
    </br>


    <?php
        if(array_key_exists('Submit', $_POST)) {
            $db = new SQLite3('../db/db.db');
            $username = $_POST["Username"];
            $accountidrec = $_POST["AccountId"];
            $accountidsend = $_POST["AccountIdSend"];
            $amount = $_POST["Amount"];
            $password = $_POST["password"];
            $sql = "SELECT Currency.Togbp From Account_Table Join Currency ON Currency.CurrencyId = Account_Table.CurrencyId WHERE Account_Table.AccountId IN ('$accountidsend','$accountidrec')"
            $thing = $db->query($sql)
            $result = $thing->fetchArray();
            $convertion = $result["Togbp"]
            $result = $thing->fetchArray();
            $convertion = $convertion / $result["Togbp"]
            $convertedamount = $amount * $convertion
            
            $sql = "SELECT Ballance From Account_Table WHERE AccountId = '$accountidsend'";
            $result = (($db->query($sql))->fetchArray());
            if ($result["Ballance"] - $ammount >= 0){
              $sql = "UPDATE Account_Table SET Ballance = Ballance - '$amount' Where AccountId = '$accountidsend'";
              $result = (($db->query($sql))->fetchArray());
              if ($result != FALSE){
                $sql = "UPDATE Account_Table SET Ballance = Ballance + '$convertedamount' Where AccountId = '$accountidrec'";
                $result = (($db->query($sql))->fetchArray());
                if($result != FALSE){
                  $time = time()
                  $sql = "INSERT INTO Transaction_Table (Ammount,time,convertion,SenderId,ReciverId) Values('$amount','$time','$convertion','$accountidsend','$accountidrec')";
                }
              }
            }
            else{
              echo "insuficient funds";
            }
            $sql = "UPDATE Account_Table SET Ballance = Ballance - '$amount' Where AccountId = '$accountidsend'";

            
            
            $result = (($db->query($sql))->fetchArray());
            if($result != False){
              if(password_verify($password, $result["PasswordHash"]) == True){
                $_SESSION["user_id"] = $result["UserId"];
                header("Location: mainpage.php");
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

  </div>

  <div class = "column right">
  <?php
    ?>
  </div>
</div>

</body>
</html> 