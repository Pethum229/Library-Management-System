<?php
include "../Common/dashboard_header.php";
?>

<style>
        .cards{
            display:flex;
            justify-content:space-between;
            flex-wrap:wrap;
        }
        .card{
            text-align:center;
            background: rgba(0, 0, 0, 0.0);
            backdrop-filter: blur(5px);
            border-radius:20px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            width:30%;
            padding:20px 0;
            margin-bottom:20px;
        }
        .card h4{
            font-size:20px;
        }
        .card h3{
            font-size:35px;
        }
        .tables{
            margin-top:30px;
        }
    </style>



    <div class="cards">
        <div class="card">
            <h4>Total Books Borrowed</h4>
            <h3>10</h3>
        </div>
        <div class="card">
            <h4>Membership Status</h4>
            <h3>Active</h3>
        </div>
        <div class="card">
            <h4>Total Reviews Given</h4>
            <h3>50</h3>
        </div>
        <div class="card">
            <h4>Book Given Status</h4>
            <h3>InActive</h3>
        </div>
        <div class="card">
            <h4>Membership Remaining</h4>
            <h3>35 Days</h3>
        </div>
        <div class="card">
            <h4>Book Must Give</h4>
            <h3>No Book Given</h3>
        </div>
    </div>
    <div class="tables">
        <div class="lastTransactions">
            <h2>Latest Transactions</h2>
            <table class="table table-bordered table-danger">
              <thead>
                <tr>
                  <th scope="col">BookID</th>
                  <th scope="col">Book Name</th>
                  <th scope="col">Borrowed Date</th>
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
    </div>


<?php
include "../Common/dashboard_footer.php";
?>