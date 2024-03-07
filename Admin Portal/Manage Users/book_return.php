<?php
session_start();

include_once "../../Common/db_connection.php";

if(isset($_POST['retun_btn'])){
    $id = $_POST['id'];
    $arrayResult = [];

    $lastTransaction = 
}

if(isset($_POST['returnBook'])){
    $id = $_POST['id'];

    try{
        $returnBook = $db->prepare("DELETE FROM users WHERE ID=?");
        $deleteUser->execute(array($id));

        $_SESSION['status'] = "Successfully deleted user";
        header("location:users.php");
        exit();

    } catch (PDOException $e) {
        $_SESSION['status'] = "Deletion of user failed: " . $e->getMessage();
        header("location:users.php");
        exit;
    }
}

?>
