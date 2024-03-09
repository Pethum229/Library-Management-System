<?php
    session_start();

    if(isset($_GET['book']) && !empty($_GET['book'])){
        $book = $_GET['book'];
        $msg = "";

        if(!isset($_SESSION['name'])){
            $msg = "Please login before the borrowing book.<br>";
        }else{
            $id = $_SESSION['id'];

            include "../Common/db_connection.php";

            try{
                $chkUser = $db->prepare("SELECT * FROM users WHERE ID=?");
                $chkUser->execute(array($id));

                $users = $chkUser->fetch(PDO::FETCH_ASSOC);

                if($users['BBStatus']==1){
                    $msg .= "You are already borrowed book.<br>"; 
                }

                $todayDate = date('Y-m-d');
                $reNewDate = $users['ReNewDate'];
                $subscription = $users['Subscription'];

                $nextReNewDate = new DateTime($reNewDate);
                $nextReNewDate->modify('+'.$subscription.'months');
                $nextDate = $nextReNewDate->format('Y-m-d');

                $dateObj1 = new DateTime($todayDate);
                $dateObj2 = new DateTime($nextDate);
                
                echo $dateObj1->format('Y-m-d')."<br>";
                echo $dateObj2->format('Y-m-d');
                

                if($dateObj2<$dateObj1){
                    $msg .= "Your subscription package expired. Please renew subscription.<br>";
                }


                $chkBook = $db->prepare("SELECT * FROM books WHERE ID=?");
                $chkBook->execute(array($book));

                $books = $chkBook->fetch(PDO::FETCH_ASSOC);

                if($books['Quantity']==$books['BorrowedQuantity']){
                    $msg .= "This book not avaliable at this time.<br>";
                }

            }catch(PDOException $e){
                $msg .= "DB Check Error : " . $e->getMessage() . "<br>";
            }
        }

        if($msg==""){
            try{
                $transaction = $db->prepare("INSERT INTO transactions (BookID, UserID, Status) VALUES(?,?,?)");
                $transaction->execute(array($book,$id,'1'));

                $bQuantityUpdate = $db->prepare("UPDATE books SET BorrowedQuantity = BorrowedQuantity+1 WHERE ID=?");
                $bQuantityUpdate->execute(array($book));

                $statusUpdate = $db->prepare("UPDATE users SET TotalBooks = TotalBooks+1, BBStatus=? WHERE ID=?");
                $statusUpdate->execute(array('1',$id));

                if($transaction->rowCount()>0 && $bQuantityUpdate->rowCount()>0 && $statusUpdate->rowCount()>0){
                    $_SESSION['status'] = "Book borrowed successfully";
                    header("location:../User Dashboard/dashboard.php");
                }else{
                    $_SESSION['status'] = "Book borrowing failed";
                    header("location:../book_inventory.php");
                }

            }catch(PDOException $e){
                $_SESSION['status']= "DB Insert/Update Error : " . $e->getMessage();
                header("location:../book_inventory.php");
            }

        }else{
            $_SESSION['status'] = $msg;
            header("location:../book_inventory.php");
        }

    }
?>