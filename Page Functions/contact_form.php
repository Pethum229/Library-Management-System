<?php

    session_start();

    $msg = "";

    if(isset($_POST['send'])){

        // Assign values to varables
        $name = $_POST['name'];

        // Validate Email
        $email = $_POST['email'];
        $email = trim($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "You entered email is invalid <br>";
        }


        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // Database Operation
        if($msg == ""){

            include_once "../Common/db_connection.php";

            try{
                $form = $db->prepare("INSERT INTO contact_forms (Name, Email, Subject, Message) VALUES(?,?,?,?)");
                $form->execute(array($name,$email,$subject,$message));

                $_SESSION['status'] = "Contact form submitted successfully";
                header("location:../contact_us.php");
                exit();
                
            }catch(PDOException $e){
                $_SESSION['status'] = "Database Error : ". $e->getMessage();
                header("location:../contact_us.php");
                exit();
            }
        }else{
            $_SESSION['status'] = $msg;
            header("location:../contact_us.php");
            exit();
        }
    }
?>