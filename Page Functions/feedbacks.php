<?php
session_start();
// Check sessin is active
if(!isset($_SESSION['role'])){
    header("location:../Login&Register/login.php");
}


?>