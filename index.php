<!-- Include Header -->
<?php
    include_once "Common/inc_header.php";
?>
    <style>
        /* Landing CSS <---Start---> */

        .landing {
            background-image: url('images/BGImg.jpg');
            height: 120vh;
            background-position: center;
            background-size: cover;
            position: relative;
            color: white;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
        }
        .search {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 90%;
            max-width: 600px;
        }
        .search h1 {
            margin-bottom: 20px;
            font-size: 2.5em;
        }
        .search p {
            margin-bottom: 20px;
            font-size: 1.2em;
        }
        .search form {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .search input[type="text"] {
            width: 70%;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }
        .search button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .search button:hover {
            background-color: #45a049;
        }

        /* Book Card CSS */

        .trendingBooks {
            position:absolute;
            top:60%;
            left:50%;
            transform: translate(-50%, -50%);
            text-align: center;
            padding: 40px 20px;
            color: #fff;
            width:100%
        }
        .trendingBooks h2{
            color:#fff;
            margin-bottom:20px;
        }
        .trending{
            display:flex;
            justify-content:space-around;
        }
        .bookCard {
            background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            overflow: hidden;
            display: flex;
            align-items:center;
            margin: 20px;
            padding: 15px;
            min-width:350px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
            transition: transform 0.3s ease;
        }
        .bookCard:hover {
            transform: scale(1.05);
        }
        .bookCard .bookImage img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
        .bookCard .bookInfo {
            margin-left: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }
        .bookCard .bookInfo .bookTitle, .bookCard .bookInfo .authorName {
            margin: 5px 0;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        .bookCard .bookInfo .isbn, .bookCard .bookInfo .remainingCount, .bookCard .bookInfo .trendingStatus {
            margin: 2px 0;
            color: #ddd;
            font-size: 0.9em;
        }
        .bookCard .bookInfo .trendingStatus {
            color: #ff4757;
            font-weight: bold;
        }
        .bookCard .bookInfo .borrowBtn {
            padding: 10px 15px;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .bookCard .bookInfo .borrowBtn:hover {
            background-color: #45a049;
        }

        /* Landing CSS <---End---> */

        /* Media Queries */

        @media screen and (max-width:1150px) {
            .bookCard{
                min-width:220px;
            }
        }

        @media screen and (max-width:910px) {
            .landing{
                height:160vh
            }
            .bookCard{
                flex-direction:column;
            }
        }

        @media screen and (max-width:765px) {
            .landing{
                height:200vh;
            }
            .bookCard{
                flex-direction:row;
                width:350px;
            }
            .trending{
                flex-direction:column;
                align-items:center;
            }
            .search{
                top:15%;
            }
        }

        @media screen and (max-width:510px) {
            .landing{
                height:230vh;
            }
            .search{
                top:20%;
            }
            .trendingBooks{
                top:65%;
            }
            .search h1{
                font-size:30px;
            }
        }

        @media screen and (max-width:375px) {
            .bookCard{
                width:300px;
            }
        }

    </style>

    <!-- Landing Page Design <-Start->-->

    <div class="landing">
        <div class="overlay"></div>
        <div class="search">
            <h1>Welcome to Our Library</h1>
            <p>Find your next book:</p>
            <form action="book_inventory.php" method="GET">
                <input type="text" placeholder="Search books..." name="homeSearch">
                <button type="submit" name="homeBookSearch">Search</button>
            </form>
        </div>

        <!-- Book Card -->

        <div class="trendingBooks">
            <h2>Trending Books</h2>
            <div class="trending">

            <!-- Fetch Trending Books to Home Page <-Start-> -->
            
            <?php
                include_once "Common/db_connection.php";

                $itemCount = 0; //For limit book count

                $fetchBooks = $db->prepare("SELECT * FROM books");
                $fetchBooks->execute();
      
                if($fetchBooks->rowCount() > 0){
                  while($row=$fetchBooks -> fetch (PDO::FETCH_ASSOC)){

                    $allQuantity = $row['Quantity'];
                    $borrowedQuantity = $row['BorrowedQuantity'];
                    $avaliability = $allQuantity - $borrowedQuantity;
                    $trending = ($borrowedQuantity/$allQuantity)*100;

                    // Get Trending Items and Limit it to 3 items
                    if($trending>=75){
                        $itemCount = $itemCount+1;
                        if($itemCount<=3){
            ?>


                <div class="bookCard">
                    <div class="bookImage">
                        <a href="Page Functions/single_book_template.php?id=<?php echo $row['ID'] ?>">
                            <img src="Admin Portal/Manage Books/Images/<?php echo $row['Images']; ?>" alt="Book Name">
                        </a>
                    </div>
                    <div class="bookInfo">
                        <a href="Page Functions/single_book_template.php?id=<?php echo $row['ID'] ?>" class="bookTitle"><?php echo $row['BookName'] ?></a>
                        <p class="authorName"><?php echo $row['AuthorName'] ?></p>
                        <p class="isbn"><?php echo $row['ISBN'] ?></p>
                        <p class="remainingCount"><?php if($avaliability<10 && $avaliability!=0) echo $avaliability." more books only avaliable";?></p>
                        <p class="trendingStatus">Trending!</p>
                        <?php
                    if($avaliability==0){
                        echo "<button class='borrowBtnList' style='background:red'>Not Avaliable</button>";
                    }else{
                        $book = $row['ID'];
                        echo "<button class='borrowBtnList'><a href='Page Functions/book_borrow.php?book=$book'>Borrow</a></button>";
                    }
                    ?>
                    </div>
                </div>
                

            <?php
                        }
                    }
                }
            }
            ?>

            <!-- Fetch Trending Books to Home Page <-End-> -->

            </div>
        </div>
    </div>

    <!-- Landing Page Design <-End->-->

<!-- Include Footer -->
<?php
    include_once "Common/inc_footer.php";
?>