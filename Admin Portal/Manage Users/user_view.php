<?php
    session_start();

    if(isset($_POST['click_view_btn'])){
        $id = $_POST['id'];

        include_once "../../Common/db_connection.php";

        $viewUser = $db->prepare("SELECT * FROM users WHERE ID=?");
        $viewUser->execute(array($id));

        if($viewUser->rowCount() > 0){
            while($row=$viewUser -> fetch (PDO::FETCH_ASSOC)){

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

                echo '
                <h6>ID : '.$row['ID'].'</h6>
                <h6>User Name : '.$row['UserName'].'</h6>
                <h6>Email : '.$row['Email'].'</h6>
                <h6>Total Books Borrowed : '.$row['TotalBooks'].'</h6>
                <h6>Current Subscription Package: '.$subscription.' Months Package.</h6>
                <h6>Current Subscription Remaining Days: '.$months.' Months '.$days.' Days</h6>
                <h6>Next Renewal Date : '.$nextDate.'</h6>
                <h6>Last Renewal Date of Subscription : '.$reNewDate.'</h6>
                <h6>Registered Date : '.$row['CreatedDate'].'</h6>
                ';
                
            }
        }
    }
?>