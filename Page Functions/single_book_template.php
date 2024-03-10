<!-- Include Header -->
<?php
    include_once "../Common/inc_header.php";
?>

<section>
    <div>
        <h2>Last Feedbacks - </h2>
        <h2>Ratings - </h2>
    </div>

    <?php
        $book = $_GET['id'];

        include "../Common/db_connection.php";

        $fetchBook = $db->prepare("SELECT books.*, feedbacks.*
                                        FROM books
                                                LEFT JOIN feedbacks ON books.ID = feedbacks.BookID
                                                        WHERE books.ID = ?");
        $fetchBook->execute(array($book));

        if($fetchBook->rowCount() > 0){
          while($row=$fetchBook -> fetch (PDO::FETCH_ASSOC)){
            $allQuantity = $row['Quantity'];
            $borrowedQuantity = $row['BorrowedQuantity'];
            $avaliability = $allQuantity - $borrowedQuantity;
            $trending = ($borrowedQuantity/$allQuantity)*100;
    ?>

    <div class="card">
        <a href="Page Functions/single_book_template.php?id=<?php echo $row['ID'] ?>">
            <img src="../Admin Portal/Manage Books/Images/<?php echo $row['Images']; ?>" alt="Book 1">
        </a>
        <div class="details">
            <h3>Book ID : <?php echo $_GET['id']; ?></h3>
            <h3>Book Name : <?php echo $row['BookName']; ?></h3>
            <h3>Author Name : <?php echo $row['AuthorName']; ?></h3>
            <h3>Book ISBN : <?php echo $row['ISBN']; ?></h3>
            <h3>Description : <?php echo $row['Summary']; ?></h3>
            <h3>Public Year : <?php echo $row['PublicYear']; ?></h3>
            <h3>Genre : <?php echo $row['Genre']; ?></h3>
            <h3><?php echo $avaliability." more books only avaliable";?></h3>
            <h3><?php if($trending>=75) echo "Trending Book"; ?></h3>
        </div>
        <?php
        if($avaliability==0){
            echo "<button style='background:red'>Not Avaliable</button>";
        }else{
            $book = $row['ID'];
            echo "<button><a href='book_borrow.php?book=$book'>Borrow</a></button>";
        }
        ?>
    </div>

    <?php
        }
    }
    ?>
</section>

<section>
    <div>
        <h1>Give us your experience about this book</h1>
        <form action="feedbacks.php" method="POST">
            
        </form>
    </div>
</section>

<!-- Include Footer -->
<?php
    include_once "../Common/inc_footer.php";
?>