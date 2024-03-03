<?php
session_start();

if(isset($_POST['addBook'])){
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


    include_once "../../Common/db_connection.php";

    try {
        $insertQuery = $db->prepare("INSERT INTO `books` (BookName, AuthorName, ISBN, Quantity, PublicYear, Genre, Summary, Images) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insertQuery->execute([$bookName, $authorName, $ISBN, $quantity, $publicYear, $genre, $summary, $fileName]);

        $_SESSION['status'] = "Book added successfully";
        header("location:books.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['status'] = "Insertion of book failed: " . $e->getMessage();
        header("location:books.php");
        exit;
    }
}
?>
