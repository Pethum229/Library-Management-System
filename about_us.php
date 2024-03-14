<!-- Include Header -->
<?php
    include_once "Common/inc_header.php";
?>

<style>

     /* About Us Page Styles <-Start-> */

    .aboutUs{
        background-image:url('images/AboutUs.jpg');
        height: 300px;
        background-position:center;
        background-size:cover;
        position:relative;
        color:white;
    }
    .overlay{
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(5px);
    }
    .text{
        position: absolute;
        margin-top:150px;
        left:50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
    .text h1{
        font-size:60px;
    }
    .history{
        display:flex;
        align-items:center;
    }
    .details{
        margin-top:30px;
        padding:20px 50px;
    }
    .historyImg img{
        width:500px;
        height:500px;
    }
    .historyDetails{
        padding-right:30px;
    }
    .historyDetails h2{
        margin-bottom:20px;
        font-size:40px;
    }
    .historyDetails p{
        margin-bottom:20px;
    }
    .mission{
        display:flex;
        align-items:center;
        margin-top:30px;
        padding:20px 30px
    }
    .missionImg img{
        width:500px;
        height:500px;
    }
    .missionDetails{
        padding-left:30px;
    }
    .missionDetails h2{
        margin-bottom:20px;
        font-size:40px;
    }
    .missionDetails p {
        margin-bottom:20px;
    }
    .contacts{
        display:flex;
        justify-content:space-around;
        padding:20px 50px;
    }
    .card{
        text-align:center;
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        overflow: hidden;
        padding: 15px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        border: 1px solid rgba(255, 255, 255, 0.18);
        min-width:250px;
        transition: transform 0.3s ease;
    }
    .card ion-icon{
        font-size:50px;
    }
    .card h3{
        margin-bottom:10px;
    }

    /* About Us Page Styles <-End-> */

    /* Media Queries */
    @media screen and (max-width:980px) {
        .contacts{
            flex-wrap:wrap;
        }
        .card{
            width:350px;
            margin-bottom:20px;
        }
    }

    @media screen and (max-width:920px) {
        .history{
            flex-direction:column;
        }
        .mission{
            flex-direction:column;
        }
        .missionDetails{
            padding-left:0;
            order:1;
        }
        .missionImg{
            order:2;
        }
    }

    @media screen and (max-width:520px) {
        .text h1{
            font-size:40px;
        }
        .historyImg img , .missionImg img{
            width:300px;
            height:300px;
        }
    }

    @media screen and (max-width:380px){
        .text h1{
            font-size:35px;
        }
        .historyDetails{
            padding-right:0;
        }
        .mission{
            padding:0;
        }
    }

</style>

    <!-- About Us Page Design <-Start-> -->

    <div class="aboutUs">
        <div class="overlay"></div>
        <div class="text">
            <h1>About Us</h1>
        </div>
    </div>

    <div class="details">
        <div class="history">
            <div class="historyDetails">
                <h2>History of Library</h2>
                <p>Welcome to Library System, a cornerstone of our community's intellectual and cultural enrichment since [Year of Establishment]. Our journey began in a modest building with just a few hundred books and the vision of providing accessible education and resources to everyone in our community.</p>
                <p>In 2024, thanks to the generous contributions of [Notable Donors or Founding Figures], we expanded our collection and moved to our current location at [Library Address], a space designed to accommodate our growing catalog and the diverse needs of our patrons. This new chapter allowed us to offer dedicated reading rooms, state-of-the-art computer labs, and community event spaces.</p>
                <p>Over the years, Library System has evolved significantly. The turn of the millennium brought digital transformation, introducing our members to the world of e-books, online databases, and digital archives. In [Year], we launched our Library Management System, streamlining the borrowing process and making our resources more accessible than ever.</p>
                <p>Join us as we continue to write the chapters of our story, together.</p>
            </div>
            <div class="historyImg">
                <img src="images/history.jpg" alt="History">
            </div>
        </div>
        <div class="mission">
            <div class="missionImg">
                <img src="images/mission.jpg" alt="Mission">
            </div>
            <div class="missionDetails">
                <h2>Our Mission</h2>
                <p>At Library System, our mission is to empower, enrich, and educate our diverse community through the free and open access to knowledge. We are dedicated to fostering a welcoming environment where ideas flourish, curiosity is nurtured, and learning is a lifelong journey.</p>
                <p>Library System is more than a place to borrow books. It is a gateway to knowledge, a catalyst for personal development, and a cornerstone of community well-being. We invite you to join us in this mission, to explore, to learn, and to grow together.</p>
            </div>
        </div>
    </div>
    <div class="contacts">
        <div class="card">
            <ion-icon name="mail"></ion-icon>
            <h3>Email</h3>
            <a href="mailto:info@library.com">info@library.com</a>
        </div>
        <div class="card">
            <ion-icon name="location"></ion-icon>
            <h3>Location</h3>
            <a href="#">Hathagala, Sri Lanka</a>
        </div>
        <div class="card">
            <ion-icon name="call"></ion-icon>
            <h3>Phone Number</h3>
            <a href="tel:+94775723816">077 572 3816 | </a>
            <a href="tel:+94713036602">071 303 6602</a>
        </div>
        <div class="card">
            <ion-icon name="hourglass"></ion-icon>
            <h3>Opening Hours</h3>
            <p>Weekdays : 8.00AM - 6.00PM</p>
            <p>Weekends : 9.00AM - 1.00PM</p>
        </div>
    </div>

    <!-- About Us Page Design <-End-> -->


<!-- Include Footer -->
<?php
    include_once "Common/inc_footer.php";
?>