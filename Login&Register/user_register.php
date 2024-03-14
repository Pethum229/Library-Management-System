<?php

session_start();

$msg ="";

if(isset($_POST['register'])){

    // Validate name
    if (empty(trim($_POST["userName"]))) {
        $msg = "Please enter your name.<br>";
    } else {
        $name = trim($_POST["userName"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $msg .= "Please enter your email.<br>";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $msg .= "Invalid email format.<br>";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $msg .= "Please enter a password.<br>";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $msg .= "Password must have at least 8 characters.<br>";
    } elseif (!preg_match("/[A-Z]/", $_POST["password"])) {
        $msg .= "Password must contain at least one uppercase letter.<br>";
    } elseif (!preg_match("/[a-z]/", $_POST["password"])) {
        $msg .= "Password must contain at least one lowercase letter.<br>";
    } elseif (!preg_match("/\d/", $_POST["password"])) {
        $msg .= "Password must contain at least one number.<br>";
    } elseif (!preg_match("/[!@#$%^&*()-_=+{};:,<.>]/", trim($_POST["password"]))) {
        $msg .= "Password must contain at least one special character.<br>";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["cPassword"]))) {
        $msg .= "Please confirm password.<br>";
    } else {
        $confirmPassword = trim($_POST["cPassword"]);
        if ($password != $confirmPassword) {
            $msg .= "Password did not match.";
        }
    }

    // Database Operations

    if($msg==""){

        include_once "../Common/db_connection.php";
    
        try{
            $emailCheck = $db->prepare("SELECT * FROM users WHERE Email =?");
            $emailCheck->execute(array($email));

            // Email Check
            if($emailCheck->rowCount>0){
                $_SESSION['status'] = "You entered email is already registerd.";
                header("location:register.php");
                exit();
            }else{
                
                $encryptPwd = password_hash($password,PASSWORD_DEFAULT);
        
                $insertUser = $db->prepare("INSERT INTO users (UserName, Email, Password, TotalBooks, Role, BBStatus, Subscription) VALUES (?,?,?,?,?,?,?)");
                $insertUser->execute(array($name, $email, $encryptPwd, '0', '0', '0', '12'));
        
                $_SESSION['status'] = "User Registered Successfully";
                header("location:login.php");
                exit();

            }
            
        }catch (PDOException $e){
            $_SESSION['status'] = "User registration failed: " . $e->getMessage();
            header("location:register.php");
            exit();
        }
    }else{
        $_SESSION['status'] = $msg;
        header("location:register.php");
        exit();
    }
}

?>
