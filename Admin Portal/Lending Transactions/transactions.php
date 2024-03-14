<?php
    include "../../Common/dashboard_header.php";
    
    // Check Login as a admin 
    if(!isset($_SESSION['role']) && $_SESSION['role']!=1){
      header("location:../../Login&Register/login.php");
    }


?>
    <style>
      .filters{
        display:flex;
        justify-content:space-between;
        margin-bottom:20px;
      }
      .filter{
        width:100%;
      }
      .filter input[type=text]{
        width:60%;
      }
      .filter form{
        display:flex;
        align-items:center;
        justify-content:space-between;
        width:100%
      }
      .filter form div{
        display:flex;
        align-items:center;
        /* width:20%; */
      }
      .filter div input{
        margin-right:10px;
      }
      .userList a{
        margin:5px 0;
      }
    </style>

<section>

    <!-- Fetch Data From Database -->

    <table class="table table-bordered table-danger">
      <thead>
        <tr>
          <th scope="col">BookID</th>
          <th scope="col">Book Name</th>
          <th scope="col">User Name</th>
          <th scope="col">Borrowed Date</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>

        <?php
          include_once "../../Common/db_connection.php";

          $fetchTransactions = $db->prepare("SELECT transactions.*, books.BookName, users.UserName
                                                    FROM transactions
                                                            JOIN books ON transactions.BookID = books.ID
                                                            JOIN users ON transactions.UserID = users.ID
                                                                    ORDER BY transactions.ID DESC");
          $fetchTransactions->execute(array());

          if($fetchTransactions->rowCount() > 0){
            while($row=$fetchTransactions -> fetch (PDO::FETCH_ASSOC)){
        ?>

              <tr>
                <td><?php echo $row['BookID']; ?></td>
                <td><?php echo $row['BookName']; ?></td>
                <td><?php echo $row['UserName']; ?></td>
                <td><?php echo $row['TransactionDate']; ?></td>
                <td><?php echo ($row['Status'] == 1) ? "Not Returned" : "Returned"; ?></td>
              </tr>

              <?php
            }
          }else{
            ?>
              <tr colspan="6">No Record Found</tr>
            <?php
          }
        ?>
      </tbody>
    </table>

</section>


<?php
    include "../../Common/dashboard_footer.php";
?>