<?php
    session_start();

    include "../../Common/db_connection.php";

    if(isset($_POST['click_edit_btn'])){
        $isbn = $_POST['isbn'];
        $arrayResult = [];
        // echo $isbn;

        $editBook = $db->prepare("SELECT * FROM books WHERE ISBN=?");
        $editBook->execute(array($isbn));

        if($editBook->rowCount() > 0){
            while($row=$editBook -> fetch (PDO::FETCH_ASSOC)){
                array_push($arrayResult, $row);
                header('content-type:application.json');
                echo json_encode($arrayResult);
            }
        }
    }

    if(isset($_POST['updateBook'])){
        $bookName = $_POST['bookName'];
        $authorName = $_POST['authorName'];
        $ISBN = $_POST['ISBN'];
        $quantity = $_POST['quantity'];
        $publicYear = $_POST['publicYear'];
        $genre = $_POST['genre'];
        $summary = $_POST['summary'];

        $fileName = $_FILES['image']['name'];
        $tempName = $_FILES['image']['tmp_name'];
        $folder = 'Images/'.$fileName;

        // Move uploaded file to destination folder
        if (!move_uploaded_file($tempName, $folder)) {
            $error = error_get_last();
            $_SESSION['status'] = "Failed to upload image. Error: " . $error['message'];
            header("location:books.php");
            exit;
        }

        try{
            $updateBooks = $db->prepare("UPDATE books SET BookName=?, AuthorName=?, ISBN=?, Quantity=?, PublicYear=?, Genre=?, Summary=?, Images=? WHERE ISBN=?");
            $updateBooks->execute(array($bookName, $authorName, $ISBN, $quantity, $publicYear, $genre, $summary, $fileName, $ISBN));

            $_SESSION['status'] = "Book updated successfully";
            header("location:books.php");
            exit;

        }catch (PDOException $e){
            $_SESSION['status'] = "Updation of book failed" . $e->getMessage();
            header("location:books.php");
            exit;
        }
    }
?>