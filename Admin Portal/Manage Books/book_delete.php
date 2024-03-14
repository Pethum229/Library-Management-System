<?php
session_start();

// Check Login as a admin 
if(!isset($_SESSION['role']) && $_SESSION['role']!=1){
    header("location:../../Login&Register/login.php");
}


if(isset($_POST['deleteBook'])){
    $isbn = $_POST['isbn'];

    include_once "../../Common/db_connection.php";

    try{
        $deleteBook = $db->prepare("DELETE FROM books WHERE ISBN=?");
        $deleteBook->execute(array($isbn));

        $_SESSION['status'] = "Successfully deleted book";
        header("location:books.php");
        exit();

    } catch (PDOException $e) {
        $_SESSION['status'] = "Deletion of book failed: " . $e->getMessage();
        header("location:books.php");
        exit;
    }
}

?>
