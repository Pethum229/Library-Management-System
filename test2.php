<!-- Include Header -->
<?php
    include_once "Common/inc_header.php";
?>

<style>
    .inventory{
        background-image:url('images/Books.jpg');
        height: 200px;
        background-position:center;
        background-size:cover;
        position:relative;
        color:white;
    }
    .overlay{
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(5px);
    }
    .text{
        position: absolute;
        margin-top:120px;
        left:50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
    .text h1{
        font-size:60px;
    }
    .content{
        display:flex;
    }
    .filter{
        width:25%;
        padding:20px 30px;
    }
    .filter h1{
        text-align:center;
        margin-bottom:10px;
    }
    .books{
        width:75%;
    }
    .searchBar{
        margin-bottom:20px;
    }
    .searchBar h4{
        margin-bottom:10px;
    }
    .searchBar input{
        width:100%;
        border:2px solid gray;
        height:40px;
        font-size:16px;
        padding-left:20px;
    }
    .availability{
        margin:20px 0;
    }
    .availability h4{
        margin-bottom:10px;
    }
    .availability label{
        margin-right:15px;
    }
    .genere{
        margin:20px 0;
    }
    .genere h4{
        margin-bottom:5px;
    }
    .genere div{
        margin-bottom:10px;
    }
    .genere div input{
        margin-right:5px;
    }
    .date{
        margin:20px 0;
    }
    .date h4{
        margin-bottom:10px;
    }
    .date label{
        margin-right:15px;
    }
    .buttons{
        margin:20px 0;
        width:100%;
        display:flex;
        justify-content:space-between;
    }
    .buttons input{
        padding:10px 20px;
    }
    .trending{
        margin:20px 0;
    }
    .trending h4{
        margin-bottom:10px;
    }
    .bookCard {
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        padding: 15px;
        margin-bottom:20px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        border: 1px solid rgba(255, 255, 255, 0.18);
        transition: transform 0.3s ease;
    }
    .bookCard:hover {
        transform: scale(1.05);
    }
    .bookCard .bookImaget img {
        width: 50px;
        height: auto;
        border-radius: 5px;
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
        color: #000;
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


    .books{
        display:flex;
        flex-wrap:wrap;
        height:fit-content;
    }
    .bookCardList {
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        flex-direction:column;
        align-items:center;
        padding: 15px;
        margin:20px 40px;
        width:220px;
        height:320px;;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        border: 1px solid rgba(255, 255, 255, 0.18);
        transition: transform 0.3s ease;
    }
    .bookCardList:hover {
        transform: scale(1.05);
    }
    .bookCardList .bookImageList img {
        width: 100px;
        height: auto;
        border-radius: 5px;
    }
    .bookInfoList {
        display: flex;
        flex-direction: column;
        align-items:center;
    }
    .bookCardList .bookInfoList .bookTitleList, .bookCardList .bookInfoList .authorNameList {
        margin: 5px 0;
        color: #000;
        text-decoration: none;
        font-weight: bold;
    }
    .bookCardList .bookInfoList .isbnList, .bookCardList .bookInfoList .remainingCountList, .bookCardList .bookInfoList .trendingStatusList {
        margin: 2px 0;
        color: #ddd;
        font-size: 0.9em;
    }
    .bookCardList .bookInfoList .trendingStatusList {
        color: #ff4757;
        font-weight: bold;
    }
    .bookCardList .bookInfoList .borrowBtnList {
        padding: 10px 15px;
        background-color: #4CAF50;
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .bookCardList .bookInfoList .borrowBtnList:hover {
        background-color: #45a049;
    }
</style>

    <div class="inventory">
        <div class="overlay"></div>
        <div class="text">
            <h1>Book Inventory</h1>
        </div>
    </div>

    <section class="content">
        <div class="filter">
            <h1>Filter Your Book</h1>
            <form>
                <div class="searchBar">
                    <h4>Search Book Name/ Author</h4>
                    <input id="bookName" type="text" placeholder="Search Book">
                </div>
                <hr>
                <div class="availability">
                    <h4>Availability</h4>
                    <div>
                        <input name="stock" type="radio" id="inStock">
                        <label for="inStock">In Stock</label>
                        <input name="stock" type="radio" id="outStock">
                        <label for="outStock">Out of Stock</label>
                    </div>
                </div>
                <hr>
                <div class="genere">
                    <h4>Filter by Genere</h4>
                    <div>
                        <input type="checkbox" id="g1">
                        <label for="g1">Action</label>
                    </div>
                    <div>
                        <input type="checkbox" id="g2">
                        <label for="g2">Adventure</label>
                    </div>
                    <div>
                        <input type="checkbox" id="g3">
                        <label for="g3">Mystry</label>
                    </div>
                    <div>
                        <input type="checkbox" id="g4">
                        <label for="g4">Fairy Tales</label>
                    </div>
                    <div>
                        <input type="checkbox" id="g5">
                        <label for="g5">Horror</label>
                    </div>
                    <div>
                        <input type="checkbox" id="g6">
                        <label for="g6">Knowladgable</label>
                    </div>
                </div>
                <hr>
                <div class="date">
                    <h4>Sort By Date</h4>
                    <div>
                        <input name="date" type="radio" id="oldest">
                        <label for="oldest">Oldest</label>
                        <input name="date" type="radio" id="lastest">
                        <label for="lastest">Lastest</label>
                    </div>
                </div>
                <hr>
                <div class="buttons">
                    <input type="submit" value="Add Filters">
                    <input type="reset" value="Clear Filters">
                </div>
                <hr>
                <div class="trending">
                    <h4>Trending Books</h4>
                    <div class="bookCard">
                        <div class="bookImaget">
                            <a href="#"><img src="images/3.jpg" alt="Book Name"></a>
                        </div>
                        <div class="bookInfo">
                            <a href="#" class="bookTitle">Book : </a>
                            <p class="authorName">Author : </p>
                        </div>
                    </div>
                    <div class="bookCard">
                        <div class="bookImaget">
                            <a href="#"><img src="images/3.jpg" alt="Book Name"></a>
                        </div>
                        <div class="bookInfo">
                            <a href="#" class="bookTitle">Book : </a>
                            <p class="authorName">Author : </p>
                        </div>
                    </div>
                    <div class="bookCard">
                        <div class="bookImaget">
                            <a href="#"><img src="images/3.jpg" alt="Book Name"></a>
                        </div>
                        <div class="bookInfo">
                            <a href="#" class="bookTitle">Book : </a>
                            <p class="authorName">Author : </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="books">
            
            <?php
                include_once "Common/db_connection.php";

                $fetchBooks = $db->prepare("SELECT * FROM books");
                $fetchBooks->execute(array());
      
                if($fetchBooks->rowCount() > 0){
                  while($row=$fetchBooks -> fetch (PDO::FETCH_ASSOC)){

                    $allQuantity = $row['Quantity'];
                    $borrowedQuantity = $row['BorrowedQuantity'];
                    $avaliability = $allQuantity - $borrowedQuantity;
                    $trending = ($borrowedQuantity/$allQuantity)*100;
            ?>

            <div class="bookCardList">
                <div class="bookImageList">
                    <a href="Page Functions/single_book_template.php?id=<?php echo $row['ID'] ?>">
                        <img src="Admin Portal/Manage Books/Images/<?php echo $row['Images']; ?>" alt="Book 1">
                    </a>
                </div>
                <div class="bookInfoList">
                    <a href="#" class="bookTitleList"><?php echo $row['BookName'] ?></a>
                    <p class="authorNameList"><?php echo $row['AuthorName'] ?></p>
                    <p class="isbnList"><?php echo $row['ISBN'] ?></p>
                    <p class="remainingCountList"><?php if($avaliability<10 && $avaliability!=0) echo $avaliability." more books only avaliable";?></p>
                    <p class="trendingStatusList"><?php if($trending>=75) echo "Trending Book"; ?></p>
                <?php
                if($avaliability==0){
                    echo "<button class='borrowBtnList' style='background:red'>Not Avaliable</button>";
                }else{
                    $book = $row['ID'];
                    echo "<button class='borrowBtnList' ><a href='Page Functions/book_borrow.php?book=$book'>Borrow</a></button>";
                }
                ?>
                </div>
            </div>

            <?php
                }
            }
            ?>

        </div>
    </section>

<!-- Include Footer -->
<?php
    include_once "Common/inc_footer.php";
?>