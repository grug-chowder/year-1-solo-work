<?php
session_start();
if(!isset($_session["UserId"])){
    header("Location: login.php");
    exit();
}