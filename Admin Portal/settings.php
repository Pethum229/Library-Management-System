<?php
include "../Common/dashboard_header.php";

// Check Login as a admin 
if(!isset($_SESSION['role']) && $_SESSION['role']!=1){
  header("location:../Login&Register/login.php");
}

$msg="";

    if(isset($_POST['chngPswd'])){

      $id = $_SESSION['id'];

      // Validate current password
      if (empty($_POST["curPswd"])) {
        $msg = "Current password is required.<br>";
      }else{
        $curPswd = test_input($_POST["curPswd"]);
      }

      // Validate new password
      if (empty(trim($_POST["newPswd"]))) {
          $msg .= "Please enter a password.<br>";
      } elseif (strlen(trim($_POST["newPswd"])) < 8) {
          $msg .= "Password must have at least 8 characters.<br>";
      } elseif (!preg_match("/[A-Z]/", $_POST["newPswd"])) {
          $msg .= "Password must contain at least one uppercase letter.<br>";
      } elseif (!preg_match("/[a-z]/", $_POST["newPswd"])) {
          $msg .= "Password must contain at least one lowercase letter.<br>";
      } elseif (!preg_match("/\d/", $_POST["newPswd"])) {
          $msg .= "Password must contain at least one number.<br>";
      } elseif (!preg_match("/[!@#$%^&*()-_=+{};:,<.>]/", trim($_POST["newPswd"]))) {
          $msg .= "Password must contain at least one special character.<br>";
      } else {
        $newPswd = test_input($_POST["newPswd"]);
      }

      // Validate confirm new password
      if (empty($_POST["confPswd"])) {
          $msg .= "Confirm new password is required.<br>";
      } elseif ($_POST["confPswd"] !== $_POST["newPswd"]) {
          $msg .= "Confirm new password does not match the new password.<br>";
      }else{
        $confPswd = test_input($_POST["confPswd"]);
        $encrPswd = password_hash($confPswd,PASSWORD_DEFAULT);
      }

      // Database Conncetion
      include "../Common/db_connection.php";

      if($msg==""){
        $chkPswd = $db->prepare("SELECT * FROM users WHERE ID=?");
        $chkPswd->execute(array($id));

        $row=$chkPswd->fetch(PDO::FETCH_ASSOC);

        if($row){
          $hashedPswd = $row['Password'];
        }

        if(password_verify($curPswd, $hashedPswd)){
          try{
              $updatePswd = $db->prepare("UPDATE users SET Password =? WHERE ID=?");
              $updatePswd->execute(array($encrPswd,$id));
              $_SESSION['status'] = "Password updated successfully";
              header("Refresh:0");
    
          }catch (PDOException $e){
              $_SESSION['status'] = "Databse Connection Error : ". $e->getMessage();
          }
        }else{
          $_SESSION['status'] = "Current password dosen't match with existing password";
        }

      }else{
        $_SESSION['status'] = $msg;
        header("Refresh:0");
      }
  }

  function test_input($value){
    $value = trim($value);
    $value = htmlspecialchars($value);
    return $value;
  }
  
?>
    <style>
      .chngPwd{
        display:flex;
        justify-content:center;
      }
      .chngPwd h1{
        text-align:center;
      }
      .chngPwd form{
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        width:50%;
        background: rgba(0, 0, 0, 0.0);
        backdrop-filter: blur(5px);
        border-radius:20px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        padding:20px 0 40px 0;
      }
      .chngPwd form div{
        display:flex;
        flex-direction:column;
        justify-content:center;
        /* align-items:center; */
        width:80%;
        margin-bottom:15px;
      }
      .chngPwd div input{
        width:100%;
        height:35px;
      }
      .chngPwd input{
        width:80%;
      }
    </style>

    <section class="chngPwd">
      <form action="" method="POST">
          <h1>Change Password</h1>
          <div>
            <label for="curPswd">Current Password</label>
            <input type="password" name="curPswd" id="curPswd">
          </div>
          <div>
            <label for="newPswd">New Password</label>
            <input type="password" name="newPswd" id="newPswd">
          </div>
          <div>
            <label for="confPswd">Confirm New Password</label>
            <input type="password" name="confPswd" id="confPswd">
          </div>
          <input type="submit" name="chngPswd" value="Change Password">
        </form>
    </section>


<?php
    include "../Common/dashboard_footer.php";
?>
