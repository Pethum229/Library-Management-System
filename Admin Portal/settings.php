<?php
    include_once "admin_layout_start.php";

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

    <section>
        <form action="" method="POST">
            <label for="curPswd">Current Password</label>
            <input type="password" name="curPswd" id="curPswd">
            <label for="newPswd">New Password</label>
            <input type="password" name="newPswd" id="newPswd">
            <label for="confPswd">Confirm New Password</label>
            <input type="password" name="confPswd" id="confPswd">
            <input type="submit" name="chngPswd" value="Change Password">
        </form>
    </section>

<?php
    include_once "admin_layout_end.php";
?>