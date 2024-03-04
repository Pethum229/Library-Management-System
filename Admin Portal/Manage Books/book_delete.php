<?php
session_start();

if(isset($_POST['click_delete_btn'])){
    $isbn = $_POST['isbn'];

    include_once "../../Common/db_connection.php";

    try{
        $deleteBook = $db->prepare("DELETE * FROM books WHERE ISBN=?");
        $deleteBook->execute(array($isbn));

        $_SESSION['status'] = "Successfully deleted book";
        header("location:books.php");
        exit();

    }catch (PDOException $e){
        $_SESSION['status'] = "Deletation of book failed" . $e->getMessage();
        header("location:books.php");
        exit;
    }
}

?>
