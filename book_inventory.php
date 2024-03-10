<!-- Include Header -->
<?php
    include_once "Common/inc_header.php";
?>

    <style>
        .filterSec{
            display:flex;
        }
        .filter{
            background:var(--primaryColor2);
            width:25%;
            padding:20px 30px;
            height:100vh;
            position:fixed;
        }
        .filter h1{
            text-align:center;
            margin-bottom:20px;
        }
        .searchBar{
            margin-bottom:10px;
        }
        .searchBar input{
            height:25px;
            width:80%;
            padding:0 10px;
            margin-top:5px;
        }
        .availability{
            margin-top:10px;
        }
        .availability div{
            margin:5px 0 10px 0;
        }
        .genere{
            margin-top:10px;
        }
        .genere h4{
            margin-bottom:10px;
        }
        .genere div{
            margin-bottom:5px;
        }
        .genere div:last-child{
            margin-bottom:10px !important;
        }
        .date{
            margin-top:10px;
        }
        .date div{
            margin:5px 0 10px 0;
        }
        .buttons{
            margin-top:10px;
        }
        .buttons input{
            background:var(--primaryColor1);
            border:none;
            font-size:16px;
            padding:5px 20px;
            color:var(--white);
            cursor:pointer;
        }
        hr{
            background:var(--black);
            height:1px;
            border:none;
        }
        .card img{
            width:200px;
        }
        .books{
            width:75%;
            padding:40px;
            display:flex;
            flex-wrap:wrap;
            justify-content:space-between;
            margin-left:calc(100% - 75%);
        }
        .card{
            background:var(--placeholder);
            padding:5px;
            text-align:center;
            margin:30px 10px;
            width:250px;
            border-radius:15px;
        }
        .details h2{
            font-size:20px;
            /* color:var(--primaryColor1); */
        }
        .details h3{
            font-size:15px;
        }
        .card button{
            padding:2px 10px;
            margin:7px 0;
            background:var(--supportColor2);
            border:1px solid black;
        }
        .card button a{
            color:var(--black);
        }
    </style>

<!-- Design Book Inventory Page <-Start-> -->

    <section class="filterSec">
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
                        <label for="inStock">In Stock</label>
                        <input name="stock" type="radio" id="inStock">
                        <label for="outStock">Out of Stock</label>
                        <input name="stock" type="radio" id="outStock">
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
                        <label for="oldest">Oldest</label>
                        <input name="date" type="radio" id="oldest">
                        <label for="lastest">Lastest</label>
                        <input name="date" type="radio" id="lastest">
                    </div>
                </div>
                <hr>
                <div class="buttons">
                    <input type="submit" value="Add Filters">
                    <input type="reset" value="Clear Filters">
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

            <div class="card">
                <a href="Page Functions/single_book_template.php?id=<?php echo $row['ID'] ?>">
                    <img src="Admin Portal/Manage Books/Images/<?php echo $row['Images']; ?>" alt="Book 1">
                </a>
                <div class="details">
                    <h2><?php echo $row['BookName'] ?></h2>
                    <h3>(<?php echo $row['AuthorName'] ?>)</h3>
                    <h3><?php echo $row['ISBN'] ?></h3>
                    <h3><?php if($avaliability<10 && $avaliability!=0) echo $avaliability." more books only avaliable";?></h3>
                    <h3><?php if($trending>=75) echo "Trending Book"; ?></h3>
                </div>
                <?php
                if($avaliability==0){
                    echo "<button style='background:red'>Not Avaliable</button>";
                }else{
                    $book = $row['ID'];
                    echo "<button><a href='Page Functions/book_borrow.php?book=$book'>Borrow</a></button>";
                }
                ?>
            </div>

            <?php
                }
            }
            ?>

        </div>
    </section>

<!-- Design Book Inventory Page <-End-> -->

<!-- Include Footer -->
<?php
    include_once "Common/inc_footer.php";
?>