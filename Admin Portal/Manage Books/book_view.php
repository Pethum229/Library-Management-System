<?php
    session_start();

    if(isset($_POST['click_view_btn'])){
        $isbn = $_POST['isbn'];
        // echo $isbn;

        include_once "../../Common/db_connection.php";

        $viewBook = $db->prepare("SELECT * FROM books WHERE ISBN=?");
        $viewBook->execute(array($isbn));

        if($viewBook->rowCount() > 0){
            while($row=$viewBook -> fetch (PDO::FETCH_ASSOC)){
                echo '
                <img src="Images/'.$row['Images'].'">
                <h6>ISBN : '.$row['ISBN'].'</h6>
                <h6>Book Name : '.$row['BookName'].'</h6>
                <h6>Author Name : '.$row['AuthorName'].'</h6>
                <h6>Quantity : '.$row['Quantity'].'</h6>
                <h6>Public Year : '.$row['PublicYear'].'</h6>
                <h6>Genre : '.$row['Genre'].'</h6>
                <h6>Summary : '.$row['Summary'].'</h6>
                ';
            }
        }
    }
?>