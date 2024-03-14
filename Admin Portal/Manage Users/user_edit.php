<?php
session_start();
// Check Login as a admin 
if(!isset($_SESSION['role']) && $_SESSION['role']!=1){
    header("location:../../Login&Register/login.php");
}

$msg="";


    include "../../Common/db_connection.php";

    if(isset($_POST['click_edit_btn'])){
        $id = $_POST['id'];
        $arrayResult = [];
        // echo $isbn;

        $editUser = $db->prepare("SELECT * FROM users WHERE ID=?");
        $editUser->execute(array($id));

        if($editUser->rowCount() > 0){
            while($row=$editUser -> fetch (PDO::FETCH_ASSOC)){

                array_push($arrayResult, $row);
                header('content-type:application.json');
                echo json_encode($arrayResult);
            }
        }
    }

    if(isset($_POST['updateUser'])){

        $ID = $_POST['id'];

        // Validate name
        if (empty($_POST["userName"])) {
            $msg = "Name is required.<br>";
        } else {
            $userName = test_input($_POST["userName"]);
        }

        // Validate email
        if (empty($_POST["email"])) {
            $msg .= "Email is required.<br>";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $msg .= "Invalid email format.<br>";
        } else {
            $email = test_input($_POST["email"]);
        }
    
        $updateQuery = "UPDATE users SET UserName=?, Email=?";
        $parameters = array($userName, $email);
    
        if(isset($_POST['subscription']) && $_POST['subscription'] != 0){
            $todayDate = date('Y-m-d');
            $subscription = $_POST['subscription'];
    
            $updateQuery .= ", Subscription=?, ReNewDate=?";
            $parameters[] = $subscription;
            $parameters[] = $todayDate;
        }
    
        if(!empty($_POST['password'])){

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

            $encryptPwd = password_hash($password, PASSWORD_DEFAULT);
    
            $updateQuery .= ", Password=?";
            $parameters[] = $encryptPwd;
        }
    
        $updateQuery .= " WHERE ID=?";
        $parameters[] = $ID;
    
        if($msg==""){

            $checkEmail = $db->prepare("SELECT * FROM users WHERE Email = ?");
            $checkEmail->execute(array($email));

            if($checkEmail->rowCount()>0){
                $_SESSION['status'] = "This email already registered";
            }else{

                try {
                    $updateUsers = $db->prepare($updateQuery);
                    $updateUsers->execute($parameters);
            
                    $_SESSION['status'] = "User updated successfully";
                    header("location:users.php");
                    exit;
                } catch (PDOException $e) {
                    $_SESSION['status'] = "Updation of user failed: " . $e->getMessage();
                    header("location:users.php");
                    exit;
                }

            }
        }else{
            $_SESSION['status'] = $msg;
            header("location:users.php");
            exit();
        }
    }

    function test_input($value){
    $value = trim($value);
    $value = htmlspecialchars($value);
    return $value;
}
    
?>