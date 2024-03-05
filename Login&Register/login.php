<!-- Include Header -->
<?php
    include_once "../Common/inc_header.php";
?>
    <style>
        .loginSec{
            display:flex;
            align-items:center;
            justify-content:center;
            height:100vh;
        }
        .loginForm{
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
        }
        .loginForm input{
            margin-bottom:20px;
        }

    </style>

    <section class="loginSec">
        <div>
            <form action="user_login.php" method="POST" class="loginForm">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" name="login" value="Login">
            </form>
            <div>
                <p>Forgot Username or Password? <a href="#">Click Here</a></p>
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </div>
    </section>

</body>
</html>