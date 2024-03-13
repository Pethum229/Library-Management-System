<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/Library-Management-System/Common/style.css">
    <style>

        /* Header CSS <---Start---> */

        .header {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.1);
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 50px;
            color: #fff;
        }
        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
        }
        .menu a, .logRegBtn a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .menu a:hover, .logRegBtn a:hover {
            color: #FED766;
        }
        .menuIcon{
            display:none;
        }
        .btn, .btnReg {
            padding: 5px 15px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            color: white;
            background-color: rgba(255, 255, 255, 0.3);
        }
        .btnReg {
            background-color: rgba(255, 255, 255, 0.5);
            color: #005A87;
        }
        .btn:hover, .btnReg:hover {
            background-color: rgba(255, 255, 255, 0.7);
            color: #005A87;
        }

        /* Header CSS <---End---> */

        /* Media Queries */
        @media screen and (max-width: 950px) {
            .menu {
                display: none;
            }
            .menuIcon{
                display:block;
            }
        }

        @media screen and (max-width: 520px){
            .navbar{
                flex-direction:column;
            }
            .navbar a{
                margin-bottom:10px;
            }
            .menuIcon{
                margin-bottom:15px;
            }
        }

        @media screen and (max-width:340px){
            .logRegBtn a{
                margin:0;
            }
        }

    </style>

</head>
<body>
    <!-- Header HTML  <-Start-> -->

        <div class="header">
            <div class="navbar">
                <a href="#" class="logo">Library<span>System</span></a>
                <div class="menu">
                    <a href="/Library-Management-System/index.php">Home</a>
                    <a href="/Library-Management-System/about_us.php">About Us</a>
                    <a href="/Library-Management-System/book_inventory.php">Book Inventory</a>
                    <a href="/Library-Management-System/contact_us.php">Contact Us</a>
                </div>
                <div class="menuIcon"><i class="fa-solid fa-bars"></i></div>
                <div class="logRegBtn">
                    <a href="/Library-Management-System/Login&Register/login.php" class="btn">Login</a>
                    <a href="/Library-Management-System/Login&Register/register.php" class="btn btnReg">Register</a>
                </div>
            </div>
        </div>
        
    <!-- Header HTML  <-End-> -->