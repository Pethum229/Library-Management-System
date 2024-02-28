<!-- Include Header -->
<?php
    include_once "inc_header.php";
?>
    <style>
        .homeSec{
            position:relative;
            background-image:url("images/BG Image.jpg");
            background-size:cover;
            background-position:center;
            height:90vh;
            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
        }
        .homeSec::before{
            content:'';
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background-color:rgba(0,0,0,0.7);
        }
        .img{
            position:absolute;
            top:50%;
            left:30%;
            transform: translate(-50%, -50%);
            z-index:1;
        }
        .details{
            position:absolute;
            left:50%;
            text-align:center;
            z-index:1;
        }
        .details h1{
            font-size:45px;
        }
        .details span{
            font-size:25px;
            color:var(--supportColor3);
        }
        .details form{
            margin-top:50px;
            display:flex;
            padding:0 20px;
        }
        .details input{
            width:70%;
            margin:0 2px;
            height:35px;
            border-radius:10px 0 0 0;
            border:none;
            padding:0 20px;
            color: var(--placeholder);
        }
        .submit{
            width:30% !important;
            border-radius:0 0 10px 0 !important;
            cursor:pointer;
            background: var(--supportColor2);
            color:var(--black) !important;
            font-size:17px;
            font-weight:500;
        }
    </style>

    <!-- Home Page Design <-Start->-->

    <section class="homeSec">
        <div class="img">
            <img src="images/Library Png.png" alt="Child with Books">
        </div>
        <div class="details">
            <h1><span>Welcome to Our Library Management System</span><br>Connecting Readers and Resources</h1>
            <form>
                <input type="text" placeholder="Search Any Book">
                <input class="submit" type="submit" value="Search">
            </form>
        </div>
    </section>

    <!-- Home Page Design <-End->-->

</body>
</html>