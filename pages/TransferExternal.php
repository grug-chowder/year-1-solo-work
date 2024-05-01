
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
  <h2>Transfer Funds Externaly:</h2>

  <form method="post">
    <div>
        <label>Ammount +/- </label>
        <input type="text" name="Ammount" required>
    </div>
    </br>
    <div>
        <label>AccountId</label>
        <input type="text" name="AccountId" required>
    </div>
    </br>
    <div>
        <label>Password</label>
        <input type="text" name="Password" required>
    </div>
    <input type="submit" value="Confirm" name="Submit">
    </br>


    <?php
        if(array_key_exists('Submit', $_POST)) {
            $db = new SQLite3('../db/db.db');
            $accountid = $_POST["AccountId"];
            $amount = floatval($_POST["Ammount"]);
            $password = $_POST["Password"];
            $userid = $_SESSION['user_id'];
            
            //verification
            $sql = "SELECT PasswordHash From User_Table Where UserId = $userid";

            $thing = $db->query($sql);
            $result = $thing->fetchArray();

            if(password_verify($password, $result["PasswordHash"]) == True){
                $sql = "SELECT UserId,Ballance From Account_Table Where AccountId = $accountid";
                $thing = $db->query($sql);
                $result = $thing->fetchArray();
                if($result["UserId"] == $userid){
                    if ($result["Ballance"] + $amount >= 0){
                        if($amount > 0){
                            $accountidrec = $accountid;
                            $accountidsend = 0;
                        }
                        else{
                            $accountidrec = 0;
                            $accountidsend = $accountid;
                        }

                      $newval = $result["Ballance"] + $amount;
                      $sql = "UPDATE Account_Table SET Ballance = $newval Where AccountId = '$accountid'";
                      if($db->query($sql)){
                        $time = time();
                        $sql = "INSERT INTO Transaction_Table (Ammount,time,convertion,SenderId,ReciverId) Values('$amount','$time',1.0,'$accountidsend','$accountidrec')";
                        if ($db->query($sql)){
                          echo "success";
                        }
                      }
                    else{
                        echo "Not Enough Money For That Maneuver";
                    }
                }
                else{
                    echo "That Account Is Not Yours";
                }
            }
            else{
                echo "Password Incorect";
            }

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