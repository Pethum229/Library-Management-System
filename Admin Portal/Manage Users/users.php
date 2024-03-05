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
                    <option value="1">3 Months Package</option>
                    <option value="1">6 Months Package</option>
                    <option value="1">12 Months Package</option>
                    <option value="1">18 Months Package</option>
                    <option value="1">24 Months Package</option>
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

    <div class="modal fade" id="deleteBookModal" tabindex="-1" aria-labelledby="deleteBookModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteBookModalLabel">Delete Book</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="book_delete.php" method="POST">
            <input type="hidden" class="form-control" name="id" id="deleteId">
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

          $fetchUsers = $db->prepare("SELECT * FROM users");
          $fetchUsers->execute(array());

          if($fetchUsers->rowCount() > 0){
            while($row=$fetchUsers -> fetch (PDO::FETCH_ASSOC)){

                $reNewDate = $row['ReNewDate'];
                $subscription = $row['Subscription'];
                $nextReNewDate = new DateTime($reNewDate);
                $nextReNewDate->modify('+'.$subscription.'months');
                $nextDate = $nextReNewDate->format('Y-m-d');

                $date1 = new DateTime($nextDate);
                $date2 = new DateTime($reNewDate);
                $difference = $date1->diff($date2);

                $months = $difference->y*12 + $difference->m;
                $days = $difference->d;

              ?>

              <tr>
                <td class="id"><?php echo $row['ID']; ?></td>
                <td><?php echo $row['UserName']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['TotalBooks']; ?></td>
                <td><?php echo "$months Months and $days Days"; ?></td>
                <td>
                  <a href="#" class="btn btn-info btn-sm viewUser">View</a>
                  <a href="#" class="btn btn-success btn-sm editData">Edit</a>
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

<!-- Insert Admin Layout End -->
<?php
    include_once "../admin_layout_end.php";
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
          // console.log(response);

          $.each(response, function(Key, value){
            // console.log(value['BookName']);

            $('#userName').val(value['UserName']);
            $('#email').val(value['Email']);
            $('#id').val(value['id']);
            $('#quantity').val(value['Quantity']);
            $('#publicYear').val(value['PublicYear']);
            $('#genre').val(value['Genre']);
            $('#summary').val(value['Summary']);

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
      $('#deleteBookModal').modal('show');

      $.ajax({
        method: "POST",
        url: "book_delete.php",
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

</script>