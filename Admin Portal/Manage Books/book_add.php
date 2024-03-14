<?php

session_start();

$msg = "";

// Check Login as an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header("location: ../../Login&Register/login.php");
}

if (isset($_POST['addBook'])) {
    // Validate book name
    if (empty($_POST["bookName"])) {
        $msg = "Book name is required.<br>";
    } else {
        $bookName = test_input($_POST["bookName"]);
    }

    // Validate author name
    if (empty($_POST["authorName"])) {
        $msg .= "Author name is required<br>";
    } else {
        $authorName = test_input($_POST["authorName"]);
    }

    // Validate ISBN
    if (empty($_POST["ISBN"])) {
        $msg .= "ISBN is required<br>";
    } elseif (!preg_match("/^[0-9]{15}$/", $_POST["ISBN"])) {
        $msg .= "ISBN must be 15 digits<br>";
    } else {
        $ISBN = test_input($_POST["ISBN"]);
    }

    // Validate quantity
    if (empty($_POST["quantity"])) {
        $msg .= "Quantity is required<br>";
    } elseif (!is_numeric($_POST["quantity"])) {
        $msg .= "Quantity must be a number<br>";
    } else {
        $quantity = test_input($_POST["quantity"]);
    }

    // Validate public year
    if (empty($_POST["publicYear"])) {
        $msg .= "Public year is required<br>";
    } elseif (!is_numeric($_POST["publicYear"])) {
        $msg .= "Public year must be a number<br>";
    } else {
        $publicYear = test_input($_POST["publicYear"]);
    }

    // Validate genre
    if (empty($_POST["genre"])) {
        $msg .= "Genre is required<br>";
    } else {
        $genre = test_input($_POST["genre"]);
    }

    // Validate summary
    if (empty($_POST["summary"])) {
        $msg .= "Summary is required<br>";
    } else {
        $summary = test_input($_POST["summary"]);
    }

    // File upload handling
    if ($_FILES['image']['error'] != 0) {
        $msg .= "Image upload failed<br>";
    } else {
        $fileName = $_FILES['image']['name'];
        $tempName = $_FILES['image']['tmp_name'];
        $folder = 'Images/' . $fileName;

        // Move uploaded file to destination folder
        if (!move_uploaded_file($tempName, $folder)) {
            $msg .= "Failed to upload image<br>";
        }
    }

    // Database Operations
    if ($msg == "") {
        include_once "../../Common/db_connection.php";

        $uniqueIsbn = $db->prepare("SELECT * FROM books WHERE ISBN=?");
        $uniqueIsbn->execute(array($ISBN));

        if($uniqueIsbn->rowCount()>0){
            $_SESSION['status'] = "ISBN Number is already registered";
            header("location:books.php");
            exit();
        }else{
            
            try {
                $insertQuery = $db->prepare("INSERT INTO `books` (BookName, AuthorName, ISBN, Quantity, PublicYear, Genre, Summary, Images) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $insertQuery->execute([$bookName, $authorName, $ISBN, $quantity, $publicYear, $genre, $summary, $fileName]);
    
                $_SESSION['status'] = "Book added successfully";
                header("location: books.php");
                exit;
    
            } catch (PDOException $e) {
                $_SESSION['status'] = "Insertion of book failed: " . $e->getMessage();
                header("location: books.php");
                exit;
            }
        }

    }else{
        $_SESSION['status'] = $msg;
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
