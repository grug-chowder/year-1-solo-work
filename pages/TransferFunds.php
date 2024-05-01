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
        <input type="text" name="AccountId" required>
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
            $amount = floatval($_POST["Amount"]);
            $password = $_POST["Password"];
            
            //verification
            $sql = "SELECT User_Table.UserName From User_Table
             Join Account_Table On Account_Table.UserId = User_Table.UserId
             Where Account_Table.UserId = $accountidrec";
            
            $thing = $db->query($sql);
            $result = $thing->fetchArray();

            if($result["UserName"] == $username){
              $userid = $_SESSION['user_id'];
              $sql = "SELECT PasswordHash From User_Table Where UserId = $userid";
              $thing = $db->query($sql);
              $result = $thing->fetchArray();
              if(password_verify($password, $result["PasswordHash"]) == True){
                    
                    //processing
                    $sql = "SELECT Currency.Togbp From Account_Table Join Currency ON Currency.CurrencyId = Account_Table.CurrencyId WHERE Account_Table.AccountId = '$accountidrec'";
                    $thing = $db->query($sql);
                    $result = $thing->fetchArray();
                    $convertion = $result["Togbp"];
                    $sql = "SELECT Currency.Togbp From Account_Table Join Currency ON Currency.CurrencyId = Account_Table.CurrencyId WHERE Account_Table.AccountId ='$accountidsend'";
                    $thing = $db->query($sql);
                    $result = $thing->fetchArray();
                    $convertion = $convertion / $result["Togbp"];


                    
                    $sql = "SELECT Ballance From Account_Table WHERE AccountId ='$accountidsend'";
                    $results = ($db->query($sql));
                    $result = $results->fetchArray();
                    if ($result["Ballance"] - $amount >= 0){
                      $newval = $result["Ballance"] - $amount;

                      $sql = "UPDATE Account_Table SET Ballance = $newval Where AccountId = '$accountidsend'";
                      
                      if ($db->query($sql)){
                        $sql = "SELECT Ballance From Account_Table WHERE AccountId ='$accountidrec'";
                        $results = ($db->query($sql));
                        $result = $results->fetchArray();
                        $newval = $result["Ballance"] + ($amount * $convertion);
                        $sql = "UPDATE Account_Table SET Ballance = $newval Where AccountId = '$accountidrec'";

                        
                        if($db->query($sql)){
                          $time = time();
                          $sql = "INSERT INTO Transaction_Table (Ammount,time,convertion,SenderId,ReciverId) Values('$amount','$time','$convertion','$accountidsend','$accountidrec')";
                          if ($db->query($sql)){
                            echo "success";
                          }
                        }
                      }
                      
                    }
                    else{
                      echo "insuficient funds";
                    }
                    $sql = "UPDATE Account_Table SET Ballance = Ballance - '$amount' Where AccountId = '$accountidsend'";
                
              }
              else{
                echo "incorect password";
              }
            }
            else{
              echo "That Account Is Not Owned By The Specified User";
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