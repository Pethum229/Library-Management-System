<?php
    session_start();

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
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $ID = $_POST['id'];
    
        $updateQuery = "UPDATE users SET UserName=?, Email=?";
        $parameters = array($userName, $email);
    
        if(isset($_POST['subscription']) && $_POST['subscription'] != 0){
            $todayDate = date('Y-m-d');
            $subscription = $_POST['subscription'];
    
            $updateQuery .= ", Subscription=?, ReNewDate=?";
            $parameters[] = $subscription;
            $parameters[] = $todayDate;
        }
    
        if(isset($_POST['password'])){
            $password = $_POST['password'];
            $cPassword = $_POST['cPassword'];
            $encryptPwd = password_hash($password, PASSWORD_DEFAULT);
    
            $updateQuery .= ", Password=?";
            $parameters[] = $encryptPwd;
        }
    
        $updateQuery .= " WHERE ID=?";
        $parameters[] = $ID;
    
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
    
?>