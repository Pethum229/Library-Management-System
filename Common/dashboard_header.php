<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Admin Portal</title>
    <style>
        body{
            margin: 0 auto;
            font-family: 'Courier New', Courier, monospace;
        }
        .sideMenus{
            height:100%;
            width:0;
            position:fixed;
            z-index:1;
            top: 0;
            left: 0;
            background:#eee;
            overflow-x: hidden;
            transition: .5s;
            padding-top: 50px;
        }
        .mainMenu h2{
            text-align: center;
            letter-spacing: 5px;
            color: #fff;
            background:#111;
            padding:10px 0;
        }
        .sideMenus .mainMenu a{
            padding:12px 12px 12px 32px;
            text-decoration: none;
            color:#111;
            display: block;
            transition:0.3s;
            font-size:18px;
            /* margin-bottom:20px; */
            text-transform:uppercase;
            font-weight:bold;
        }
        .sideMenus a i{
            padding-right:15px;
        }
        .closebtn i{
            font-size:25px;
        }
        .closebtn{
            padding:0;
        }
        .mainMenu a:hover{
            color:#000;
            background:#fff;
            padding:12px 5px;
        }
        .sideMenus .closebtn{
            position:absolute;
            top:0;
            right:25px;
            font-size:36px;
            margin-left:50px;
        }
        #contentArea{
            transition:margin-left .5s;
            padding:16px;
            width:100%;
        }
        .header{
            background:#eee;
            padding:11px 25px;
            display:flex;
            justify-content:space-between;
            align-items:center ;
        }
        .header p{
            font-size:17px;
            margin:0;
        }
        .header i{
            font-size:25px;
        }
        .include{
            padding:30px;
        }

        /* Media Queries */


    </style>
</head>
<body>
    <div id="sideMenus" class="sideMenus">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa-solid fa-xmark"></i></a>
        <div class="mainMenu">
            <h2>Library Management System</h2>
            <?php
                if($_SESSION['role']==1){
            ?>

            <!-- Admin Dashboard -->
            <a href="/Library-Management-System/Admin Portal/dashboard.php"><i class="fa-solid fa-gauge"></i>Dashboard</a>
            <a href="/Library-Management-System/Admin Portal/Manage Books/books.php"><i class="fa-solid fa-book-open"></i>Books</a>
            <a href="/Library-Management-System/Admin Portal/Manage Users/users.php"><i class="fa-solid fa-user"></i>Users</a>
            <a href="/Library-Management-System/Admin Portal/Lending Transactions/transactions.php"><i class="fa-solid fa-hand-holding-hand"></i>Transactions</a>
            <a href="/Library-Management-System/Admin Portal/settings.php"><i class="fa-solid fa-gear"></i>Settings</a>
            <a href="/Library-Management-System/Login&Register/logout.php"><i class="fa-solid fa-right-from-bracket"></i>Log Out</a>

            <?php
                }elseif($_SESSION['role']==0){
            ?>
            
            <!-- User Dashboard -->
            <a href="/Library-Management-System/User Dashboard/dashboard.php"><i class="fa-solid fa-gauge"></i>Dashboard</a>
            <a href="/Library-Management-System/User Dashboard/transactions.php"><i class="fa-solid fa-hand-holding-hand"></i>Transactions</a>
            <a href="/Library-Management-System/User Dashboard/reviews.php"><i class="fa-solid fa-star"></i>Reviews</a>
            <a href="/Library-Management-System/USer Dashboard/settings.php"><i class="fa-solid fa-gear"></i>Settings</a>
            <a href="/Library-Management-System/Login&Register/logout.php"><i class="fa-solid fa-right-from-bracket"></i>Log Out</a>

            <?php
                }
            ?>

        </div>
    </div>
    <div class="contentArea">
        <div class="header">
            <i class="fa-solid fa-bars" onclick="openNav()"></i>
            <p>Hello! <?php echo $_SESSION['name']; ?></p>
        </div>

        <div class="include">