<?php

session_start();

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

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
                    header("location:../User Dashboard/dashboard.php");
                    exit();
                }elseif($role == '1'){
                    $_SESSION['name']=$name;
                    $_SESSION['id']=$id;
                    $_SESSION['role']=$role;
                    header("location:../Admin Portal/dashboard.php");
                    exit();

                }
            }else{
                header("location:login.php");
                exit();
            }
        }
    }catch(PDOException $e){
        $_SESSION['status'] = "Login Failed : " . $e->getMessage();
        echo $_SESSION['status'];
        header("location:login.php");
        exit();
    }
}

?>