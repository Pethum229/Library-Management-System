<?php

if(isset($_POST['register'])){
    $name = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cPassword = $_POST['cPassword'];

    include_once "../Common/db_connection.php";

    try{
        $insertUser = $db->prepare("INSERT INTO users ");
        
    }catch (PDOException $e){

    }
}

?>