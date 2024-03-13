<!-- Include Header -->
<?php
    include_once "../Common/inc_header.php";
?>

    <style>
        .card{
            display:flex;
            padding: 80px 30px 0 100px;
        }
        .card a img{
            width:210px;
            height:280px;
            margin-right:100px;
        }
        .bookName{
            font-size:44px;
            margin-bottom:10px;
        }
        .details h3{
            margin-bottom:5px;
            font-size:16px;
        }
        .footerDetails{
            padding: 0 30px 0 100px;
            margin-top:30px;
        }
        .footerDetails h2{
            margin-bottom:10px;
        }
        .footerDetails h3{
            margin-bottom:40px;
            font-size:16px;
        }
        .borrow{
            margin-top:15px;
        }
        .borrow a{
            padding:15px 25px;
            font-size:20px;
        }
        .experience form textarea{
            width:100%;
            padding:10px 0 0 10px;
            margin-bottom:5px;
        }
        .experience form input[type=submit]{
            margin-bottom:30px;
        }
        .reviews h2{
            margin-bottom:20px;
        }
        .reviews div{
            margin-bottom:15px;
        }
    </style>

<section>
    <!-- <div>
        <h2>Last Feedbacks - </h2>
        <h2>Ratings - </h2>
    </div> -->

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
            <h3 class="bookID">Book ID : <?php echo $_GET['id']; ?></h3>
            <h2 class="bookName"><?php echo $row['BookName']; ?></h2>
            <h3 class="authorName">Author Name : <?php echo $row['AuthorName']; ?></h3>
            <h3 class="ISBN">Book ISBN : <?php echo $row['ISBN']; ?></h3>
            <h3 class="publicYear">Public Year : <?php echo $row['PublicYear']; ?></h3>
            <h3 class="genere">Genre : <?php echo $row['Genre']; ?></h3>
            <h3><?php echo $avaliability." more books only avaliable";?></h3>
            <h3><?php if($trending>=75) echo "Trending Book"; ?></h3>
            <?php
            if($avaliability==0){
                echo "<button style='background:red'>Not Avaliable</button>";
            }else{
                $book = $row['ID'];
                echo "<button class='borrow'><a href='book_borrow.php?book=$book'>Borrow</a></button>";
            }
            ?>
        </div>
    </div>
</section>

<section class="footerDetails">
    <div>
        <h2>Description</h2>
        <h3 class="description"><?php echo $row['Summary']; ?></h3>
    </div>

    <?php
        }
    }
    ?>

    <div class="experience">
        <h2>Give us your experience about this book</h2>
        <form action="feedbacks.php" method="POST">
            <textarea name="" id="" cols="5" rows="5" placeholder="Write if anything about this book"></textarea>
            <input type="submit" value="Send Feedback">
        </form>
    </div>
    <div class="reviews">
        <h2>Lastest Reviews</h2>
        <div>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia ducimus repellendus blanditiis nihil aperiam? Expedita maiores tempore soluta est, ducimus fugiat veritatis dolor, illum ipsam quas iure explicabo, vitae sapiente?</p>
            <p>- Username -</p>
        </div>
        <div>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia ducimus repellendus blanditiis nihil aperiam? Expedita maiores tempore soluta est, ducimus fugiat veritatis dolor, illum ipsam quas iure explicabo, vitae sapiente?</p>
            <p>- Email -</p>
        </div>
    </div>
</section>


<!-- Include Footer -->
<?php
    include_once "../Common/inc_footer.php";
?>