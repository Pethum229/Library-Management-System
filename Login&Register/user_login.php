<?php

session_start();

$msg="";

if(isset($_POST['login'])){

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $msg = "Please enter your email.<br>";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $msg = "Please enter your password.<br>";
    } else {
        $password = trim($_POST["password"]);
    }

    // Database Operations
    
    if($msg==""){

        include_once "../Common/db_connection.php";
    
        try{
            $checkUser = $db->prepare("SELECT * FROM users WHERE email=?");
            $checkUser->execute(array($email));
    
            if($checkUser->rowCount()>0){
                $result = $checkUser->fetch();
    
                if(password_verify($password,$result['Password'])){
                    $name = $result['UserName'];
                    $id = $result['ID'];
                    $role = $result['Role'];
    
                    if($role == '0'){
                        $_SESSION['name']=$name;
                        $_SESSION['id']=$id;
                        $_SESSION['role']=$role;
                        $_SESSION['status'] = "User Login Successful";
                        header("location:../User Dashboard/dashboard.php");
                        exit();

                    }elseif($role == '1'){
                        $_SESSION['name']=$name;
                        $_SESSION['id']=$id;
                        $_SESSION['role']=$role;
                        $_SESSION['status'] = "Admin Login Successful";
                        header("location:../Admin Portal/dashboard.php");
                        exit();
    
                    }
                }else{
                    $_SESSION['status'] = "Password that you entered is wrong";
                    header("location:login.php");
                    exit();
                }
            }else{
                $_SESSION['status'] = "Email that you enteres is not registered";
                header("location:login.php");
                exit();
            }
        }catch(PDOException $e){
            $_SESSION['status'] = "Login Failed : " . $e->getMessage();
            header("location:login.php");
            exit();
        }
    }else{
        $_SESSION['status'] = $msg;
        header("location:login.php");
        exit();
    }
}

?>