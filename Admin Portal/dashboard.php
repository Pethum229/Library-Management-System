<?php
    include "../Common/dashboard_header.php";
?>
    <style>
        .cards{
            display:flex;
            justify-content:space-between;
        }
        .card{
            text-align:center;
            background: rgba(0, 0, 0, 0.0);
            backdrop-filter: blur(5px);
            border-radius:20px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            width:30%;
            padding:20px 0;
        }
        .card h4{
            font-size:20px;
        }
        .card h3{
            font-size:35px;
        }
        .tables{
          display:flex;
          justify-content:space-between;
          margin-top:30px;
        }
        .lastTransactions{
          width:75%;
          padding:0 10px;
        }
        .newUsers{
          width:25%;
          padding:0 10px;
        }
    </style>



    <div class="cards">
        <div class="card">
            <h4>Total Books</h4>
            <h3>10</h3>
        </div>
        <div class="card">
            <h4>Total Users</h4>
            <h3>30</h3>
        </div>
        <div class="card">
            <h4>Total Transactions</h4>
            <h3>50</h3>
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
        <div class="newUsers">
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

<?php
    include "../Common/dashboard_footer.php";
?>