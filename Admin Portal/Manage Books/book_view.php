<?php
session_start();

// Check Login as a admin 
if(!isset($_SESSION['role']) && $_SESSION['role']!=1){
    header("location:../../Login&Register/login.php");
}


    if(isset($_POST['click_view_btn'])){
        $isbn = $_POST['isbn'];
        // echo $isbn;

        include_once "../../Common/db_connection.php";

        $viewBook = $db->prepare("SELECT * FROM books WHERE ISBN=?");
        $viewBook->execute(array($isbn));

        if($viewBook->rowCount() > 0){
            while($row=$viewBook -> fetch (PDO::FETCH_ASSOC)){

                $allQuantity = $row['Quantity'];
                $borrowedQuantity = $row['BorrowedQuantity'];
                $avaliability = $allQuantity - $borrowedQuantity;

                echo '
                <img src="Images/'.$row['Images'].'">
                <h6>ISBN : '.$row['ISBN'].'</h6>
                <h6>Book Name : '.$row['BookName'].'</h6>
                <h6>Author Name : '.$row['AuthorName'].'</h6>
                <h6>All Quantity : '.$row['Quantity'].'</h6>
                <h6>Avaliable Quantity : '.$avaliability.'</h6>
                <h6>Public Year : '.$row['PublicYear'].'</h6>
                <h6>Genre : '.$row['Genre'].'</h6>
                <h6>Summary : '.$row['Summary'].'</h6>
                ';
            }
        }
    }
?>