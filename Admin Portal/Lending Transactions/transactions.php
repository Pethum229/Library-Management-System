<!-- Insert Admin Layout Start -->
<?php
    include_once "../admin_layout_start.php";
?>

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

<!-- Insert Admin Layout End -->
<?php
    include_once "../admin_layout_end.php";
?>

<script>

  // View Data Popup Model

  $(document).ready(function(){
    $('.viewData').click(function(e){
      e.preventDefault();

      var isbn = $(this).closest('tr').find('.isbn').text();
      // console.log(isbn);

      $.ajax({
        method: "POST",
        url: "book_view.php",
        data: {
          'click_view_btn': true,
          'isbn':isbn,
        },
        success: function(response){
          // console.log(response);

          $('.viewBook').html(response);
          $('#viewBookModal').modal('show');

        }
      });

    });
  });

  // Edit Data Popup Model
 
  $(document).ready(function(){
    $('.editData').click(function(e){
      e.preventDefault();

      var isbn = $(this).closest('tr').find('.isbn').text();
      console.log(isbn);

      $.ajax({
        method: "POST",
        url: "book_edit.php",
        data: {
          'click_edit_btn': true,
          'isbn':isbn,
        },
        success: function(response){
          // console.log(response);

          $.each(response, function(Key, value){
            // console.log(value['BookName']);

            $('#bookName').val(value['BookName']);
            $('#authorName').val(value['AuthorName']);
            $('#isbn').val(value['ISBN']);
            $('#quantity').val(value['Quantity']);
            $('#publicYear').val(value['PublicYear']);
            $('#genre').val(value['Genre']);
            $('#summary').val(value['Summary']);

          });

          $('#editData').modal('show');
        }
      });

    });
  });


  // Delete Data Popup Model

  $(document).ready(function (){
    $('.deleteData').click(function(e){
      e.preventDefault();
      
      var isbn = $(this).closest('tr').find('.isbn').text();
      $('#deleteId').val(isbn);
      $('#deleteBookModal').modal('show');

      $.ajax({
        method: "POST",
        url: "book_delete.php",
        data:{
          'delete_btn':true,
          'isbn':isbn,
        },
        success:function (response){
          console.log(response);
        }
      });

    });
  });

</script>