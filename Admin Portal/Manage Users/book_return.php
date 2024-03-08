<?php
session_start();

include_once "../../Common/db_connection.php";

if(isset($_POST['return_btn'])){
    $id = $_POST['id'];
    $arrayResult = [];

    $lastTransaction =  $db->prepare("SELECT transactions.*, books.BookName FROM transactions 
                                            JOIN books ON transactions.BookID = books.ID
                                                    WHERE transactions.UserID = ?
                                                                ORDER BY transactions.ID DESC LIMIT 1");
    $lastTransaction->execute(array($id));

    if($lastTransaction->rowCount()>0){
        // Fetch the last transaction row
        $row = $lastTransaction->fetch(PDO::FETCH_ASSOC);

        // Store additional data in the associative array
        $todayDate = date("Y-m-d");
        $borrowDate = $row['TransactionDate'];
        $limit = 15;
        $fine = 10;
        $deadline = date("Y-m-d", strtotime($borrowDate . " + " . $limit . " days"));

        $today = strtotime($todayDate);
        $dead = strtotime($deadline);

        if($today>$dead){
            $date1 = new DateTime($todayDate);
            $date2 = new DateTime($deadline);

            $difference = $date1->diff($date2);
            $diffInDays = $difference->days;

            $totalFine = $diffInDays*$fine;

            // Add new key-value pairs to the associative array
            $row["Deadline"] = $deadline;
            $row["LateDate"] = $diffInDays;
            $row["Fine"] = $totalFine;
        } else {
            $row["Deadline"] = $deadline;
            $row["LateDate"] = 0;
            $row["Fine"] = 0;
        }

        // Return the array as JSON
        header('Content-Type: application/json');
        echo json_encode($row);
    }
}

if(isset($_POST['returnBook'])){
    $id = $_POST['id'];

    try{
        $returnBook = $db->prepare("UPDATE users SET BBStatus=?");
        $returnBook->execute(array('0'));

        $_SESSION['status'] = "Successfully updated user";
        header("location:users.php");
        exit();

    } catch (PDOException $e) {
        $_SESSION['status'] = "Deletion of user failed: " . $e->getMessage();
        header("location:users.php");
        exit;
    }
}

?>
