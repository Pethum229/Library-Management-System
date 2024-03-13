<!-- Include Header -->
<?php
    include_once "../Common/inc_header.php";
?>
    <style>
        /* login CSS <---Start---> */

        .login {
            background-image: url('../images/Login.jpg');
            height: 100vh;
            background-position: center;
            background-size: cover;
            position: relative;
            color: white;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(0px);
        }
        .loginFlex{
            display:flex;
            justify-content:center;
            align-items:center;
            width:100%;
            height:100%;
        }
        .loginSec{
            display:flex;
            align-items:center;
            justify-content:space-around;
            background: rgba(0, 0, 0, 0.0);
            backdrop-filter: blur(5px);
            border-radius:20px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            width:65%;
        }
        .login h1{
            text-align:center;
            margin-bottom:20px;
        }
        .loginForm{
            width:50%;
            padding: 0 20px 0 40px;
        }
        .loginForm form div{
            display:flex;
            flex-direction:column;
        }
        .loginForm div input{
            height:35px;
            border:1px solid #fff;
            margin:7px 0 20px 0;
            padding-left:20px;
            background:transparent;
            border-radius:7px;
        }
        .loginForm form label{
            font-size:14px;
        }
        .loginForm form button{
            width:100%;
            font-size:16px;
            padding:5px 0;
            margin-bottom:15px;
        }
        .loginForm div p{
            font-size:14px;
        }
        .loginImg img{
            width:350px;
            height:350px;
        }

        /* login CSS <---End---> */

        @media screen and (max-width:900px) {
            .loginSec{
                padding:20px 0;
            }
            .loginImg img{
                width:250px;
                height:250px;
            }
        }

        @media screen and (max-width:730px) {
            .login{
                height:140vh;
            }
            .loginSec{
                flex-direction:column;
            }
            .loginForm{
                width:90%;
            }
        }

        @media screen and (max-width:530px) {
            .login{
                height:160vh;
            }
            .loginImg img{
                width:150px;
                height:150px;
            }
            .loginForm{
                width:100%;
                padding-left:20px;
            }
        }

        @media screen and (max-width:400px) {
            .loginSec{
                width:90%;
            }
        }

    </style>

    <!-- login Page Design <-Start->-->

    <div class="login">
        <div class="overlay"></div>
        <div class="loginFlex">
            <div class="loginSec">
                <div class="loginForm">
                    <h1>Login</h1>
                    <form action="user_login.php" method="POST">
                        <div>
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" placeholder="Email">
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password">
                        </div>
                        <button type="submit" name="login">Login</button>
                    </form>
                    <div>
                        <p>Don't have an account? <a href="register.php">Register</a></p>
                    </div>
                </div>
                <div class="loginImg">
                    <img src="../images/loginImg.png" alt="Logins">
                </div>
            </div>
        </div>

    </div>

    <!-- login Page Design <-End->-->

<!-- Include Footer -->
<?php
    include_once "../Common/inc_footer.php";
?>