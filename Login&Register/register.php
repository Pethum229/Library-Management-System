<!-- Include Header -->
<?php
    include_once "../Common/inc_header.php";
?>
    <style>
        /* register CSS <---Start---> */

        .register {
            background-image: url('../images/login.jpg');
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
        .registerFlex{
            display:flex;
            justify-content:center;
            align-items:center;
            width:100%;
            height:100%;
        }
        .registerSec{
            display:flex;
            align-items:center;
            justify-content:space-around;
            background: rgba(0, 0, 0, 0.0);
            backdrop-filter: blur(5px);
            border-radius:20px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            width:65%;
            padding:20px 0;
        }
        .register h1{
            text-align:center;
            margin-bottom:20px;
        }
        .registerForm{
            width:50%;
            padding: 0 40px 0 20px;
        }
        .registerForm form div{
            display:flex;
            flex-direction:column;
        }
        .registerForm div input{
            height:35px;
            border:1px solid #fff;
            margin:7px 0 20px 0;
            padding-left:20px;
            background:transparent;
            border-radius:7px;
        }
        .registerForm form label{
            font-size:14px;
        }
        .registerForm form button{
            width:100%;
            font-size:16px;
            padding:5px 0;
            margin-bottom:15px;
        }
        .registerForm div p{
            font-size:14px;
        }
        .registerImg img{
            width:350px;
            height:350px;
        }

        /* register CSS <---End---> */

        /* Media Query */
        @media screen and (max-width:1000px) {
            .register{
                height:120vh;
            }
        }

        @media screen and (max-width:880px) {
            .registerImg img{
                width:200px;
                height:200px;
            }
        }

        @media screen and (max-width:700px) {
            .register{
                height:180vh;
            }
            .registerSec{
                flex-direction:column-reverse;
            }
            .registerForm{
                width:90%;
                margin-bottom:20px;
                padding:0;
            }
        }

        @media screen and (max-width:450px) {
            .register{
                height:200vh;
            }
            .registerSec{
                width:80%;
            }
        }

    </style>

    <!-- register Page Design <-Start->-->

    <div class="register">
        <div class="overlay"></div>
        <div class="registerFlex">
            <div class="registerSec">
                <div class="registerImg">
                    <img src="../images/signupImg.png" alt="registers">
                </div>
                <div class="registerForm">
                    <h1>SignUp</h1>
                    <form action="user_register.php" method="POST">
                        <div>
                            <label for="name">User Name</label>
                            <input type="text" name="userName" required id="name" placeholder="User Name">
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="text" name="email" required id="email" placeholder="Email">
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" name="password" required id="password" placeholder="Password">
                        </div>
                        <div>
                            <label for="cPassword">Confirm Password</label>
                            <input type="password" name="cPassword" required id="cPassword" placeholder="Confirm Password">
                        </div>
                        <button type="submit" name="register">SignUp</button>
                    </form>
                    <div>
                        <p>Already have an account? <a href="login.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- register Page Design <-End->-->

<!-- Include Footer -->
<?php
    include_once "../Common/inc_footer.php";
?>