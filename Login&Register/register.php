<!-- Include Header -->
<?php
    include_once "../Common/inc_header.php";
?>

    <style>
        .registerSec{
            display:flex;
            align-items:center;
            justify-content:center;
            height:100vh;
        }
        .registerForm{
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
        }
        .registerForm input,select{
            margin-bottom:20px;
        }
    </style>

    <section class="registerSec">
        <div>
            <form class="registerForm" action="user_register.php" method="POST">
                <input type="text" placeholder="Name">
                <input type="text" placeholder="Email">
                <input type="password" placeholder="Password">
                <input type="password" placeholder="Confirm Password">
                <input type="submit" name="register" value="Register">
            </form>
            <div>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </section>

</body>
</html>