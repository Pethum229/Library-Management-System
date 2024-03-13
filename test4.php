<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Portal</title>
    <style>
        body{
            margin: 0;
            font-family: 'Courier New', Courier, monospace;
        }
        .sideMenu{
            height:100%;
            width:0;
            position:fixed;
            z-index:1;
            top: 0;
            left: 0;
            background:#eee;
            overflow-x: hidden;
            transition: .5s;
            padding-top: 30px;
        }
        .mainMenu h2{
            text-align: center;
            letter-spacing: 5px;
            color: #fff;
            background:#111;
            padding:10px 0;
        }
        .sideMenu a{
            padding:12px 12px 12px 32px;
            text-decoration: none;
            color:#111;
            display: block;
            transition:0.3s;
            font-size:18px;
            margin-bottom:20px;
            text-transform:uppercase;
            font-weight:bold;
        }
        .sideMenu a i{
            padding-right:15px;
        }
        .closebtn i{
            font-size:25px;
        }
        .mainMenu a:hover{
            color:#000;
            background:#fff;
            padding:12px 5px;
        }
        .sideMenu .closebtn{
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
            padding:0 25px;
            display:flex;
            justify-content:space-between;
            align-items:center
        }
        .header p{
            font-size:17px;
        }
        .header i{
            font-size:25px;
        }
        .include{
            padding:30px;
        }
    </style>
</head>
<body>
    <div id="sideMenu" class="sideMenu">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa-solid fa-xmark"></i></a>
        <div class="mainMenu">
            <h2>Libray Management System</h2>
            <a href="#"><i class="fa-solid fa-gauge"></i>Dashboard</a>
            <a href="#"><i class="fa-solid fa-book-open"></i>Books</a>
            <a href="#"><i class="fa-solid fa-user"></i>Users</a>
            <a href="#"><i class="fa-solid fa-hand-holding-hand"></i>Transactions</a>
            <a href="#"><i class="fa-solid fa-gear"></i>Settings</a>
            <a href="#"><i class="fa-solid fa-right-from-bracket"></i>Log Out</a>
        </div>
    </div>
    <div class="contentArea">
        <div class="header">
            <i class="fa-solid fa-bars" onclick="openNav()"></i>
            <p>Hello! Pethum</p>
        </div>

        <div class="include">

        </div>
    </div>


    <script>

        function openNav() {
            document.getElementById("sideMenu").style.width = "300px";
            document.querySelector(".contentArea").style.marginLeft = "300px";
        }

        function closeNav() {
            document.getElementById("sideMenu").style.width = "0";
            document.querySelector(".contentArea").style.marginLeft = "0";
        }

    </script>
</body>
</html>