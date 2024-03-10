<?php
include_once "admin_layout_start.php";
include "../Common/db_connection.php";

try {
    // Fetch total number of books
    $books = $db->prepare("SELECT COUNT(*) AS bookCount FROM books");
    $books->execute();
    $result = $books->fetch(PDO::FETCH_ASSOC);
    $bookCount = $result['bookCount'] ?? 0;

    // Fetch total number of users
    $users = $db->prepare("SELECT COUNT(*) AS userCount FROM users");
    $users->execute();
    $result1 = $users->fetch(PDO::FETCH_ASSOC);
    $userCount = $result1['userCount'] ?? 0;

    // Fetch total number of transactions
    $transactions = $db->prepare("SELECT COUNT(*) AS transactionCount FROM transactions");
    $transactions->execute();
    $result2 = $transactions->fetch(PDO::FETCH_ASSOC);
    $transactionCount = $result2['transactionCount'] ?? 0;
} catch (PDOException $e) {
    // Handle database connection errors or query errors
    echo "Database error: " . $e->getMessage();
    die();
}
?>

<section>
    <div>
        <div>
            <h5>Total Books</h5>
            <h3><?php echo htmlspecialchars($bookCount); ?></h3>
        </div>
        <div>
            <h5>Total Users</h5>
            <h3><?php echo htmlspecialchars($userCount); ?></h3>
        </div>
        <div>
            <h5>Total Transactions</h5>
            <h3><?php echo htmlspecialchars($transactionCount); ?></h3>
        </div>
    </div>
    <div>
        <div>
            <h2>Latest Transactions</h2>
            <table class="table table-bordered table-danger">
              <thead>
                <tr>
                  <th scope="col">BookID</th>
                  <th scope="col">Book Name</th>
                  <th scope="col">User Name</th>
                </tr>
              </thead>
              <tbody>

                <?php
                  include_once "../Common/db_connection.php";

                  $fetchUsers = $db->prepare("SELECT transactions.*, books.BookName, users.UserName
                                                            FROM transactions
                                                                    JOIN books ON transactions.BookID = books.ID
                                                                    JOIN users ON transactions.UserID = users.ID
                                                                            ORDER BY transactions.ID DESC LIMIT 10");
                  $fetchUsers->execute(array());

                  if($fetchUsers->rowCount() > 0){
                    while($row=$fetchUsers -> fetch (PDO::FETCH_ASSOC)){
                ?>

                      <tr>
                        <td><?php echo $row['BookID']; ?></td>
                        <td><?php echo $row['BookName']; ?></td>
                        <td><?php echo $row['UserName']; ?></td>
                      </tr>
                    
                      <?php
                    }
                  }else{
                    ?>
                      <tr colspan="3">No Record Found</tr>
                    <?php
                  }
                ?>
              </tbody>
            </table>
        </div>
        <div>
            <h2>New Users</h2>
            <table class="table table-bordered table-danger">
              <thead>
                <tr>
                  <th scope="col">User ID</th>
                  <th scope="col">User Name</th>
                </tr>
              </thead>
              <tbody>

                <?php
                  include_once "../Common/db_connection.php";

                  $fetchUsers = $db->prepare("SELECT * FROM users ORDER BY ID DESC LIMIT 10");
                  $fetchUsers->execute(array());

                  if($fetchUsers->rowCount() > 0){
                    while($row=$fetchUsers -> fetch (PDO::FETCH_ASSOC)){
                ?>

                      <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['UserName']; ?></td>
                      </tr>
                    
                      <?php
                    }
                  }else{
                    ?>
                      <tr colspan="2">No Record Found</tr>
                    <?php
                  }
                ?>
              </tbody>
            </table>
        </div>
    </div>
</section>

<?php
include_once "admin_layout_end.php";
?>
