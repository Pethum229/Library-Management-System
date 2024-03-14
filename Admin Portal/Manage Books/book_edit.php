<?php
session_start();

$msg="";

// Check Login as a admin 
if(!isset($_SESSION['role']) && $_SESSION['role']!=1){
    header("location:../../Login&Register/login.php");
}


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

        // Validate book name
        $bookName = test_input($_POST["bookName"]);

        // Validate author name
        $authorName = test_input($_POST["authorName"]);

        // Validate ISBN
        if (!preg_match("/^[0-9]{15}$/", $_POST["ISBN"])) {
            $msg = "ISBN must be 15 digits<br>";
        } else {
            $ISBN = test_input($_POST["ISBN"]);
        }

        // Validate quantity
        if (!is_numeric($_POST["quantity"])) {
            $msg .= "Quantity must be a number<br>";
        } else {
            $quantity = test_input($_POST["quantity"]);
        }

        // Validate public year
        if (!is_numeric($_POST["publicYear"])) {
            $msg .= "Public year must be a number<br>";
        } else {
            $publicYear = test_input($_POST["publicYear"]);
        }

        // Validate genre
        $genre = test_input($_POST["genre"]);

        // Validate summary
        $summary = test_input($_POST["summary"]);

        // if(isset($_POST['image'])){
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
        // }

        if($msg==""){

            $uniqueIsbn = $db->prepare("SELECT * FROM books WHERE ISBN=?");
            $uniqueIsbn->execute(array($ISBN));
    
            if($uniqueIsbn->rowCount()>0){
                $_SESSION['status'] = "ISBN Number is already registered";
                header("location:books.php");
                exit();
            }else

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
        }else{
            $_SESSION['status']=$msg;
            header("location:books.php");
            exit();
        }
    }

    function test_input($value){
        $value = trim($value);
        $value = htmlspecialchars($value);
        return ($value);
    }

?>