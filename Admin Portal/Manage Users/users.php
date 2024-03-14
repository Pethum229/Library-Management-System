<?php
include "../../Common/dashboard_header.php";

// Check Login as a admin 
if(!isset($_SESSION['role']) && $_SESSION['role']!=1){
  header("location:../../Login&Register/login.php");
}

if(isset($_GET['clear'])){
  header("Location: {$_SERVER['PHP_SELF']}");
  exit;
}

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
      .filters button a{
        text-decoration:none;
        color:#fff;
      }
      .userList a{
        margin:5px 0;
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
        <form action="" method="GET">
          <input type="text" name="user" placeholder="Search Users">
          <input type="submit" name="filter" value="Filter">
          <input type="submit" name="clear" value="Clear Filters">
        </form>
      </div>
      <button type="button" class="btn btn-primary"><a href="../../Login&Register/register.php">
        Add New User
      </a></button>
    </div>

    <!-- View Book Details Modal -->

    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="viewUserModalLabel">View User Details</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="viewUserDiv">

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Edit User -->

    <div class="modal fade" id="editUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editUserLabel">Edit User</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="user_edit.php" method="POST">
            <div class="modal-body">
              <input type="hidden" class="form-control" id="id" name="id">
              <div class="form-group mb-3">
                <input type="text" class="form-control" id="userName" name="userName" placeholder="User Name">
              </div>
              <div class="form-group mb-3">
                  <input type="text" class="form-control" id="email"  name="email" placeholder="Email">
              </div>
              <div class="form-group mb-3">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              </div>
              <div class="form-group mb-3">
                  <input type="password" class="form-control" id="cPassword" name="cPassword" placeholder="Confirm Password">
              </div>
              <div class="form-group mb-3">
                  <label for="subscription">Select New Subscription Package</label>
                  <select name="subscription" id="subscription">
                    <option value="0">Select New Subscription Package</option>
                    <option value="1">1 Months Package</option>
                    <option value="3">3 Months Package</option>
                    <option value="6">6 Months Package</option>
                    <option value="12">12 Months Package</option>
                    <option value="18">18 Months Package</option>
                    <option value="24">24 Months Package</option>
                  </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="updateUser" class="btn btn-primary">Update User</button>
            </div>
        </form>
        </div>
      </div>
    </div>


    <!-- Delete Book Details Modal -->

    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserkModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteUserModalLabel">Delete Book</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="user_delete.php" method="POST">
            <input type="hidden" class="form-control" name="id" id="deleteId">
            <div class="modal-body">
              <h4>Are you sure, You want to delete this User?</h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="deleteUser" class="btn btn-danger">Yes! Delete User</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Book Return Confirmation Modal -->

    <div class="modal fade" id="bookReturnModal" tabindex="-1" aria-labelledby="bookReturnModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="bookReturnModalLabel">Return Book</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="book_return.php" method="POST">
            <input type="hidden" class="form-control" name="id" id="returnId">
            <div class="modal-body">
              <h4>User returnd the correct book?</h4>
              <div>
                <h6 id="bookName"></h6>
                <h6 id="bookIsbn"></h6>
                <h6 id="borrowDate"></h6>
                <h6 id="deadline"></h6>
                <h6 id="lateDate"></h6>
                <h6 id="fine"></h6>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="returnBook" class="btn btn-danger">Yes!</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Fetch Data From Database -->

    <table class="table table-bordered table-danger">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">User Name</th>
          <th scope="col">Email</th>
          <th scope="col">Total Books Borrowed</th>
          <th scope="col">Subscription Remaining</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php
          include_once "../../Common/db_connection.php";

          $fetchUsers = "SELECT * FROM users";
          $parameters=[];

          if(isset($_GET['user'])){
            $userName = $_GET['user'];
            $searchTerm = "%$userName%";

            $fetchUsers .= " WHERE UserName LIKE ? OR Email LIKE ?";
            $parameters[] = $searchTerm;
            $parameters[] = $searchTerm;
          }

          $filtered = $db->prepare($fetchUsers);
          $filtered->execute($parameters);

          if($filtered->rowCount() > 0){
            while($row=$filtered -> fetch (PDO::FETCH_ASSOC)){

                $todayDate = date('Y-m-d');

                $reNewDate = $row['ReNewDate'];
                $subscription = $row['Subscription'];
                $nextReNewDate = new DateTime($reNewDate);
                $nextReNewDate->modify('+'.$subscription.'months');
                $nextDate = $nextReNewDate->format('Y-m-d');

                $date1 = new DateTime($nextDate);
                $date2 = new DateTime($todayDate);
                $difference = $date1->diff($date2);

                $months = $difference->y*12 + $difference->m;
                $days = $difference->d;

              ?>

              <tr class="userList">
                <td class="id"><?php echo $row['ID']; ?></td>
                <td><?php echo $row['UserName']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['TotalBooks']; ?></td>
                <td><?php echo "$months Months and $days Days"; ?></td>
                <td>
                  <a href="#" class="btn btn-info btn-sm viewUser">View</a>
                  <a href="#" class="btn btn-success btn-sm editData">Edit</a>
                  <?php
                  if($row['BBStatus']=="1"){
                    echo "<a href='#' class='btn btn-success btn-sm returnBook'>Mark as book returned</a>";
                  }
                  ?>
                  <a href="#" class="btn btn-danger btn-sm deleteData">Delete</a>
                </td>
              </tr>

              <?php
            }
          }else{
            ?>
              <tr colspan="4">No Record Found</tr>
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
    $('.viewUser').click(function(e){
      e.preventDefault();

      var id = $(this).closest('tr').find('.id').text();
      // console.log(id);

      $.ajax({
        method: "POST",
        url: "user_view.php",
        data: {
          'click_view_btn': true,
          'id':id,
        },
        success: function(response){
          // console.log(response);

          $('.viewUserDiv').html(response);
          $('#viewUserModal').modal('show');

        }
      });

    });
  });

  // Edit Data Popup Model
 
  $(document).ready(function(){
    $('.editData').click(function(e){
      e.preventDefault();

      var id = $(this).closest('tr').find('.id').text();

      $.ajax({
        method: "POST",
        url: "user_edit.php",
        data: {
          'click_edit_btn': true,
          'id':id,
        },
        success: function(response){
          console.log(response);

          $.each(response, function(Key, value){
            // console.log(value['BookName']);

            $('#userName').val(value['UserName']);
            $('#email').val(value['Email']);
            $('#id').val(value['ID']);
          });

          $('#editUser').modal('show');
        }
      });

    });
  });


  // Delete Data Popup Model

  $(document).ready(function (){
    $('.deleteData').click(function(e){
      e.preventDefault();
      
      var id = $(this).closest('tr').find('.id').text();
      $('#deleteId').val(id);
      $('#deleteUserModal').modal('show');

      $.ajax({
        method: "POST",
        url: "user_delete.php",
        data:{
          'delete_btn':true,
          'id':id,
        },
        success:function (response){
          console.log(response);
        }
      });

    });
  });


  // Return Book Popup Model

  $(document).ready(function (){
    $('.returnBook').click(function(e){
      e.preventDefault();
      
      var id = $(this).closest('tr').find('.id').text();
      $('#returnId').val(id);
      $('#bookReturnModal').modal('show');

      $.ajax({
        method: "POST",
        url: "book_return.php",
        data:{
          'return_btn':true,
          'id':id,
        },
        success:function (response){
          console.log(response);

          // Check if the response is a valid object
          if (typeof response === 'object') {
            // Access the properties of the response object
            $('#bookName').text('Book Name: ' + response['BookName']);
            $('#bookIsbn').text('Book ISBN: ' + response['ISBN']);
            $('#borrowDate').text('Borrow Date: ' + response['TransactionDate']);
            $('#deadline').text('Deadline: ' + response['Deadline']);
            $('#lateDate').text('Late Date: ' + response['LateDate']);
            $('#fine').text('Fine: ' + response['Fine']);
          } else {
            console.error('Invalid JSON response:', response);
          }
        },
        error: function(xhr, status, error) {
          console.error('AJAX error:', error);
        }
      });

    });
});


</script>

