<!-- Insert Admin Layout Start -->
<?php
    include_once "../admin_layout_start.php";
?>

<!-- Button Trigger Model -->
<section>
    <?php
      if(isset($_SESSION['status']) && $_SESSION['status']!=''){
        ?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Alert!</strong> <?php echo $_SESSION['status']; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <?php
        unset($_SESSION['status']);
      }
    ?>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertData">
      Add New Book
    </button>

    <!-- Modal -->
    <div class="modal fade" id="insertData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="insertDataLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Add New Book -->

          <div class="modal-header">
            <h1 class="modal-title fs-5" id="insertDataLabel">Add New Book</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="book_add.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group mb-3">
                  <input type="text" class="form-control" name="bookName" placeholder="Book Name">
              </div>
              <div class="form-group mb-3">
                  <input type="text" class="form-control" name="authorName" placeholder="Author Name">
              </div>
              <div class="form-group mb-3">
                  <input type="text" class="form-control" name="ISBN" placeholder="ISBN">
              </div>
              <div class="form-group mb-3">
                  <input type="number" class="form-control" name="quantity" placeholder="Quantity">
              </div>
              <div class="form-group mb-3">
                  <input type="text" class="form-control" name="publicYear" placeholder="Publication Year">
              </div>
              <div class="form-group mb-3">
                  <input type="text" class="form-control" name="genre" placeholder="Genre">
              </div>
              <div class="form-group mb-3">
                  <input type="text" class="form-control" name="summary" placeholder="Summary">
              </div>
              <div class="form-group mb-3">
                  <input type="file" class="form-control" name="image">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="addBook" class="btn btn-primary">Add Book</button>
            </div>
        </form>
        </div>
      </div>
    </div>

    <!-- View Book Details Modal -->

    <div class="modal fade" id="viewBookModal" tabindex="-1" aria-labelledby="viewBookModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="viewBookModalLabel">View Book Details</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="viewBook">

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Fetch Data From Database -->

    <table class="table table-striped table-bordered table-danger">
      <thead>
        <tr>
          <th scope="col">ISBN</th>
          <th scope="col">Book Image</th>
          <th scope="col">Book Name</th>
          <th scope="col">Author Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php
          include_once "../../Common/db_connection.php";

          $fetchBooks = $db->prepare("SELECT * FROM books");
          $fetchBooks->execute(array());

          if($fetchBooks->rowCount() > 0){
            while($row=$fetchBooks -> fetch (PDO::FETCH_ASSOC)){
              ?>

              <tr>
                <td class="isbn"><?php echo $row['ISBN']; ?></td>
                <td><img src="Images/<?php echo $row['Images']; ?>"  style="width:50px;"></td>
                <td><?php echo $row['BookName']; ?></td>
                <td><?php echo $row['AuthorName']; ?></td>
                <td><?php echo $row['Quantity']; ?></td>
                <td><a href="#" class="btn btn-info btn-sm view_data">View</a></td>
              </tr>

              <?php
            }
          }else{
            ?>
              <tr colspan="9">No Record Found</tr>
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

<!-- View Data Popup Model -->
<script>
  $(document).ready(function(){
    $('.view_data').click(function(e){
      e.preventDefault();

      // console.log("Hello");
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
</script>