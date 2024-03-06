<?php
    session_start();

    if(isset($_GET['book']) && !empty($_GET['book'])){
        $book = $_GET['book'];
        $msg = "";

        if(!isset($_SESSION['name'])){
            $msg = "Please login before the borrowing book";
        }else{
            $id = $_SESSION['id'];
        }

        include "../Common/db_connection.php";

        try{
            $chkUser = $db->prepare("SELECT * FROM users WHERE ID=");
            $chkUser->execute(array($id));

            $users = $chkUser->fetch(PDO::FETCH_ASSOC);

            if($users['BBStatus']==1){
                $msg .= "You are already borrowed book"; 
            }

            // User subscription is activated?
        }catch(PDOException $e){

        }

    }
?>