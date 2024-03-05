<?php

session_start();

if(isset($_POST['register'])){
    $name = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cPassword = $_POST['cPassword'];

    include_once "../Common/db_connection.php";

    try{
        $encryptPwd = password_hash($password,PASSWORD_DEFAULT);

        $insertUser = $db->prepare("INSERT INTO users (UserName, Email, Password, TotalBooks, Role, Subscription) VALUES (?,?,?,?,?,?)");
        $insertUser->execute(array($name, $email, $encryptPwd, '0', '0', '12'));

        $_SESSION['status'] = "User Registered Successfully";
        header("location:login.php");
        exit();
        
    }catch (PDOException $e){
        $_SESSION['status'] = "User registration failed: " . $e->getMessage();
        header("location:register.php");
        exit();
    }
}

?>
