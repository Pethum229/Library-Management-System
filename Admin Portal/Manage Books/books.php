<?php
    include "../../Common/dashboard_header.php";
?>
    <style>
      .filters{
        display:flex;
        justify-content:space-between;
        margin-bottom:20px;
      }
      .filter{
        width:70%;
      }
      .filter input[type=text]{
        width:60%;
      }
    </style>

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

    <div class="filters">
      <div class="filter">
        <form action="">
          <input type="text" placeholder="Search Book">
          <input type="submit" value="Filter">
        </form>
      </div>
      <button type="button" class="btn btn-primary addBtn" data-bs-toggle="modal" data-bs-target="#insertData">
        Add New Book
      </button>
    </div>

    <!-- Add New Book -->

    <div class="modal fade" id="insertData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="insertDataLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
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


    <!-- Edit Book -->

    <div class="modal fade" id="editData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editDataLabel">Edit Book</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="book_edit.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group mb-3">
                  <input type="text" class="form-control" id="bookName" name="bookName" placeholder="Book Name">
              </div>
              <div class="form-group mb-3">
                  <input type="text" class="form-control" id="authorName"  name="authorName" placeholder="Author Name">
              </div>
              <div class="form-group mb-3">
                  <input type="text" class="form-control" id="isbn" name="ISBN">
              </div>
              <div class="form-group mb-3">
                  <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
              </div>
              <div class="form-group mb-3">
                  <input type="text" class="form-control" id="publicYear" name="publicYear" placeholder="Publication Year">
              </div>
              <div class="form-group mb-3">
                  <input type="text" class="form-control" id="genre" name="genre" placeholder="Genre">
              </div>
              <div class="form-group mb-3">
                  <input type="text" class="form-control" id="summary" name="summary" placeholder="Summary">
              </div>
              <div class="form-group mb-3">
                  <input type="file" class="form-control" id="image" name="image">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="updateBook" class="btn btn-primary">Update Book</button>
            </div>
        </form>
        </div>
      </div>
    </div>


    <!-- Delete Book Details Modal -->

    <div class="modal fade" id="deleteBookModal" tabindex="-1" aria-labelledby="deleteBookModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteBookModalLabel">Delete Book</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="book_delete.php" method="POST">
            <input type="hidden" class="form-control" name="isbn" id="deleteId">
            <div class="modal-body">
              <h4>Are you sure, You want to delete this Book?</h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="deleteBook" class="btn btn-danger">Yes! Delete Book</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Fetch Data From Database -->

    <table class="table table-bordered table-danger">
      <thead>
        <tr>
          <th scope="col">ISBN</th>
          <th scope="col">Book Image</th>
          <th scope="col">Book Name</th>
          <th scope="col">Author Name</th>
          <th scope="col">Avaliable Quantity</th>
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

              $allQuantity = $row['Quantity'];
              $borrowedQuantity = $row['BorrowedQuantity'];
              $avaliability = $allQuantity - $borrowedQuantity;
              $trending = ($borrowedQuantity/$allQuantity)*100;

              ?>

              <tr class='<?php if($trending>=75) echo "table-primary"?>'>
                <td class="isbn"><?php echo $row['ISBN']; ?></td>
                <td><img src="Images/<?php echo $row['Images']; ?>"  style="width:50px;"></td>
                <td><?php echo $row['BookName']; ?></td>
                <td><?php echo $row['AuthorName']; ?></td>
                <td><?php echo $avaliability; ?></td>
                <td>
                  <a href="#" class="btn btn-info btn-sm viewData">View</a>
                  <a href="#" class="btn btn-success btn-sm editData">Edit</a>
                  <a href="#" class="btn btn-danger btn-sm deleteData">Delete</a>
                </td>
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