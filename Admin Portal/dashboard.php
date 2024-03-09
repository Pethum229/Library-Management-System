<?php
    include_once "admin_layout_start.php";

    include "../Common/db_connection.php";

    $books = $db->prepare("SELECT COUNT(*) AS bookCount FROM books");
    $result = $books->fetch(PDO::FETCH_ASSOC);
    $bookCount = $result['bookCount'];

    $users = $db->prepare("SELECT COUNT(*) AS userCount FROM users");
    $result1 = $users->fetch(PDO::FETCH_ASSOC);
    $userCount = $result1['userCount'];

    $transactions = $db->prepare("SELECT COUNT(*) AS transactionCount FROM transactions");
    $result2 = $transactions->fetch(PDO::FETCH_ASSOC);
    $transactionCount = $result2['transactionCount'];

?>

    <section>
            <div>
                <div>
                    <h5>Total Books</h5>
                    <h3><?php echo $bookCount ?></h3>
                </div>
                <div>
                    <h5>Total Users</h5>
                    <h3><?php echo $userCount ?></h3>
                </div>
                <div>
                    <h5>Total Transactions</h5>
                    <h3><?php echo $transactionCount ?></h3>
                </div>
            </div>
            <div>
                <div>
                    <h2>Lastest Transactions</h2>

                </div>
                <div>
                    <h2>New Users</h2>
                    
                </div>
            </div>
    </section>

<?php
    include_once "admin_layout_end.php";
?>