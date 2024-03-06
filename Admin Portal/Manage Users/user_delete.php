<?php
session_start();

if(isset($_POST['deleteUser'])){
    $id = $_POST['id'];

    include_once "../../Common/db_connection.php";

    try{
        $deleteUser = $db->prepare("DELETE FROM users WHERE ID=?");
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
