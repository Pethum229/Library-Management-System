<?php

include "../Common/dashboard_header.php";

// Check sessin is active
if(!isset($_SESSION['role'])){
  header("location:../Login&Register/login.php");
}


    if(isset($_POST['chngPswd'])){
      $curPswd = $_POST['curPswd'];
      $newPswd = $_POST['newPswd'];
      $confPswd = $_POST['confPswd'];
      $encrPswd = password_hash($confPswd,PASSWORD_DEFAULT);
      $id = $_SESSION['id'];

      include "../Common/db_connection.php";

      try{
          $selectQuery = $db->prepare("SELECT Password FROM users WHERE ID=?");
          $selectQuery->execute(array($id));

          $updatePswd = $db->prepare("UPDATE users SET Password =? WHERE ID=?");
          $updatePswd->execute(array($encrPswd,$id));

      }catch (PDOException $e){
          $_SESSION['status'] = "Databse Connection Error : ". $e->getMessage();
      }
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
