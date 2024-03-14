<!-- Include Header -->
<?php
    include_once "Common/inc_header.php";

    // Clear All Filters

    if(isset($_GET['clear'])){
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
?>

<style>

    /* Book Inventory Styles <-Start-> */

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
    .filterIcon i{
        font-size:30px;
        padding:30px 20px 0 20px;
        display:none;
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

    /* Book Inventory Styles <-End-> */

    /* Media Quaries */

    @media screen and (max-width:1200px) {
        .bookCardList{
            margin:20px 20px;
        }
    }

    @media screen and (max-width:1050px) {
        .filter{
            display:none;
        }
        .filterIcon i{
            display:block;
        }
        .bookCardList{
            margin:20px 20px;
        }
    }

    @media screen and (max-width:910px) {
        .bookCardList{
            margin:20px 40px;
        }
        .text h1{
            font-size:40px;
        }
    }

    @media screen and (max-width:800px) {
        .bookCardList{
            margin:20px 20px;
        }
    }
</style>

    <!-- Book Inventory Design <-Start-> -->

    <div class="inventory">
        <div class="overlay"></div>
        <div class="text">
            <h1>Book Inventory</h1>
        </div>
    </div>

    <section class="content">
        <div class="filterIcon"><i class="fa-solid fa-filter"></i></div>
        <div class="filter">
            <h1>Filter Your Book</h1>
            <form method="GET">
                <div class="searchBar">
                    <h4>Search Book Name/ Author</h4>
                    <input id="bookName" type="text" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>" placeholder="Search Book">
                </div>
                <hr>
                <div class="availability">
                    <h4>Availability</h4>
                    <div>
                        <input name="stock" value="1" <?php echo isset($_GET['stock']) && $_GET['stock'] == 1 ? 'checked' : '' ?> type="radio" id="inStock">
                        <label for="inStock">In Stock</label>
                        <input name="stock" value="0" <?php echo isset($_GET['stock']) && $_GET['stock'] == 0 ? 'checked' : '' ?> type="radio" id="outStock">
                        <label for="outStock">Out of Stock</label>
                    </div>
                </div>
                <hr>
                <div class="genere">
                    <h4>Filter by Genere</h4>
                    <div>
                        <input name="action" value="Action" <?php echo isset($_GET['action']) ? 'checked' : '' ?> type="checkbox" id="g1">
                        <label for="g1">Action</label>
                    </div>
                    <div>
                        <input name="adventure" value="Adventure" <?php echo isset($_GET['adventure']) ? 'checked' : '' ?> type="checkbox" id="g2">
                        <label for="g2">Adventure</label>
                    </div>
                    <div>
                        <input name="mystry" value="Mystry" <?php echo isset($_GET['mystry']) ? 'checked' : '' ?> type="checkbox" id="g3">
                        <label for="g3">Mystry</label>
                    </div>
                    <div>
                        <input name="fairyTales" value="Fairy Tales" <?php echo isset($_GET['fairyTales']) ? 'checked' : '' ?> type="checkbox" id="g4">
                        <label for="g4">Fairy Tales</label>
                    </div>
                    <div>
                        <input name="horror" value="Horror" <?php echo isset($_GET['horror']) ? 'checked' : '' ?> type="checkbox" value="Horror" id="g5">
                        <label for="g5">Horror</label>
                    </div>
                    <div>
                        <input name="knowladgable" value="Knowladgable" <?php echo isset($_GET['knowladgable']) ? 'checked' : '' ?> type="checkbox" id="g6">
                        <label for="g6">Knowladgable</label>
                    </div>
                </div>
                <hr>
                <div class="date">
                    <h4>Sort By Date</h4>
                    <div>
                        <input name="date" value="desc" <?php echo isset($_GET['date']) && $_GET['date'] == "desc" ? 'checked' : '' ?> type="radio" id="oldest">
                        <label for="oldest">Oldest</label>
                        <input name="date" value="asc"  <?php echo isset($_GET['date']) && $_GET['date'] == "asc" ? 'checked' : '' ?> type="radio" id="lastest">
                        <label for="lastest">Lastest</label>
                    </div>
                </div>
                <hr>
                <div class="buttons">
                    <input type="submit" name="searchBtn" value="Add Filters">
                    <input type="submit" name="clear" value="Clear Filters">
                </div>
                <hr>
                <div class="trending">
                    <h4>Trending Books</h4>

                    <!-- Fetch Trending Books -->

                    <?php
                        include_once "Common/db_connection.php";

                        $itemCount=0; //For limit book count

                        $fetchBooks = $db->prepare("SELECT * FROM books");
                        $fetchBooks->execute();

                        if($fetchBooks->rowCount() > 0){
                          while($row=$fetchBooks -> fetch (PDO::FETCH_ASSOC)){
                        
                            $allQuantity = $row['Quantity'];
                            $borrowedQuantity = $row['BorrowedQuantity'];
                            $avaliability = $allQuantity - $borrowedQuantity;
                            $trending = ($borrowedQuantity/$allQuantity)*100;
                        
                            // Get Trending Items and Limit it to 5 items
                            if($trending>=75){
                                $itemCount = $itemCount+1;
                                if($itemCount<=5){
                            
                    ?>
   
                        <div class="bookCard">
                            <div class="bookImaget">
                                <a href="Page Functions/single_book_template.php?id=<?php echo $row['ID'] ?>">
                                    <img src="Admin Portal/Manage Books/Images/<?php echo $row['Images']; ?>" alt="Book Name">
                                </a>
                            </div>
                            <div class="bookInfo">
                                <a href="Page Functions/single_book_template.php?id=<?php echo $row['ID'] ?>" class="bookTitle"><?php echo $row['BookName'] ?></a>
                                <p class="authorName"><?php echo $row['AuthorName'] ?></p>
                            </div>
                        </div>
                        
                        
                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </form>
        </div>

        <!-- Book Card Design <-Start->-->

        <div class="books">

            <!-- Fetch books from database -->
            
            <?php
                include_once "Common/db_connection.php";

                $selectQuery = "SELECT * FROM books";
                $parameters = array();
                
                // Check if search query is provided
                if(isset($_GET['homeBookSearch']) && !empty($_GET['homeSearch'])) {
                    $book = $_GET['homeSearch'];
                    $searchTerm = "%$book%";
                    $selectQuery .= " WHERE BookName LIKE ? OR AuthorName LIKE ?";
                    $parameters[] = $searchTerm;
                    $parameters[] = $searchTerm;
                }
                
                // Check if search button is clicked
                if(isset($_GET['searchBtn'])) {
                    $selectQuery .= " WHERE 1=1";
                
                    // Check if search term is provided
                    if(isset($_GET['search'])) {
                        $book = $_GET['search'];
                        $searchTerm = "%$book%";
                        $selectQuery .= " AND (BookName LIKE ? OR AuthorName LIKE ?)";
                        $parameters[] = $searchTerm;
                        $parameters[] = $searchTerm;
                    }
                
                    // Check if stock filter is applied
                    if(isset($_GET['stock'])) {
                        $stock = $_GET['stock'];
                        if($stock == 1) {
                            $selectQuery .= " AND (Quantity - BorrowedQuantity) > 0";
                        } else {
                            $selectQuery .= " AND (Quantity - BorrowedQuantity) = 0";
                        }
                    }
                
                    // Check if genre filter is applied
                    if(isset($_GET['action'])) {
                        $genre = $_GET['action'];
                        $selectQuery .= " AND Genre = ?";
                        $parameters[] = $genre;
                    }
                    if(isset($_GET['adventure'])) {
                        $genre = $_GET['adventure'];
                        $selectQuery .= " AND Genre = ?";
                        $parameters[] = $genre;
                    }
                    if(isset($_GET['mystry'])) {
                        $genre = $_GET['mystry'];
                        $selectQuery .= " AND Genre = ?";
                        $parameters[] = $genre;
                    }
                    if(isset($_GET['fairyTales'])) {
                        $genre = $_GET['fairyTales'];
                        $selectQuery .= " AND Genre = ?";
                        $parameters[] = $genre;
                    }
                    if(isset($_GET['horror'])) {
                        $genre = $_GET['horror'];
                        $selectQuery .= " AND Genre = ?";
                        $parameters[] = $genre;
                    }
                    if(isset($_GET['knowladgable'])) {
                        $genre = $_GET['knowladgable'];
                        $selectQuery .= " AND Genre = ?";
                        $parameters[] = $genre;
                    }
                
                    // Check if order by date is applied
                    if(isset($_GET['date'])) {
                        $order = $_GET['date'];
                        $selectQuery .= " ORDER BY ID $order";
                    }
                }
                
                $fetchBooks = $db->prepare($selectQuery);
                $fetchBooks->execute($parameters);
                
      
                if($fetchBooks->rowCount() > 0){
                  while($row=$fetchBooks -> fetch (PDO::FETCH_ASSOC)){

                    // Add features like trending books and etc

                    $allQuantity = $row['Quantity'];
                    $borrowedQuantity = $row['BorrowedQuantity'];
                    $avaliability = $allQuantity - $borrowedQuantity;
                    $trending = ($borrowedQuantity/$allQuantity)*100;
            ?>

            <div class="bookCardList">
                <div class="bookImageList">
                    <a href="Page Functions/single_book_template.php?id=<?php echo $row['ID'] ?>">
                        <img src="Admin Portal/Manage Books/Images/<?php echo $row['Images']; ?>" alt="Book Image">
                    </a>
                </div>
                <div class="bookInfoList">
                    <a href="Page Functions/single_book_template.php?id=<?php echo $row['ID'] ?>" class="bookTitleList"><?php echo $row['BookName'] ?></a>
                    <p class="authorNameList"><?php echo $row['AuthorName'] ?></p>
                    <p class="isbnList"><?php echo $row['ISBN'] ?></p>
                    <p class="remainingCountList"><?php if($avaliability<10 && $avaliability!=0) echo $avaliability." more books only avaliable";?></p>
                    <p class="trendingStatusList"><?php if($trending>=75) echo "Trending Book"; ?></p>
                <?php
                if($avaliability==0){
                    echo "<button class='borrowBtnList' style='background:red'>Not Avaliable</button>";
                }else{
                    $books = $row['ID'];
                    echo "<button class='borrowBtnList' ><a href='Page Functions/book_borrow.php?book=$books'>Borrow</a></button>";
                }
                ?>
                </div>
            </div>

            <?php
                }
            }else{
                $_SESSION['status'] = "No books related to your search";
            }
            ?>

        </div>

        <!-- Book Card Design <-End->-->
    </section>

    <!-- Book Inventory Design <-End-> -->

<!-- Include Footer -->
<?php
    include_once "Common/inc_footer.php";
?>