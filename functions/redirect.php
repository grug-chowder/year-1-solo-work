<?php
if(!isset($_session["UserId"])){
    header("Location: login.php");
}