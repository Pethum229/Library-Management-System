<!-- Include Header -->
<?php
    include_once "Common/inc_header.php";
?>

<style>
    .contactUs{
        background-image:url('images/contacts.jpg');
        height: 300px;
        background-position:center;
        background-size:cover;
        position:relative;
        color:#fff;
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
    .contacts{
        display:flex;
        align-items:center;
    }
    .form{
        width:50%;
        padding:20px 40px 0 0;
    }
    .details{
        width:50%;
        display:flex;
        flex-wrap:wrap;
    }
    .card{
        text-align:center;
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        overflow: hidden;
        padding: 15px;
        width:25%;
        height:200px;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        margin:20px;
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
    .form form div{
        display:flex;
        flex-direction:column;
        margin:10px 0;
    }
    .form form input{
        margin:5px 0;
        height:40px;
        padding-left:10px;
    }
    .form form textarea{
        margin:5px 0;
        padding:10px 0 0 10px;
    }
    .form form div button{
        font-size:16px;
        padding:10px 0;
    }

    /* Media Quaries */

    @media screen and (max-width:1160px) {
        .card{
            min-width:200px;
        }
    }
    
    @media screen and (max-width:960px) {
        .contacts{
            flex-direction:column;
            /* align-items:center; */
        }
        .details{
            width:100%;
            justify-content:center;
        }
        .card{
            width:200px;
            min-width:100px;
        }
    }

    @media screen and (max-width:530px) {
        .text h1{
            font-size:40px;
        }
        .form{
            padding:20px 0 0 0;
            width:80%;
        }
    }
</style>

    <div class="contactUs">
        <div class="overlay"></div>
        <div class="text">
            <h1>Contact Us</h1>
        </div>
    </div>

    <div class="contacts">
        <div class="details">
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
        <div class="form">
            <h2>Send us anything!</h2>
            <form action="">
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" placeholder="Pethum Priyashantha">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="text" id="email" placeholder="contact.pethum@gmail.com">
                </div>
                <div>
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" placeholder="Subject of your problem or reason">
                </div>
                <div>
                    <label for="message">Message</label>
                    <textarea name="" placeholder="Type anything if you feel..." id="message" rows="8"></textarea>
                </div>
                <div>
                    <button type="submit">Send Us</button>
                </div>
            </form>
        </div>
    </div>

<!-- Include Footer -->
<?php
    include_once "Common/inc_footer.php";
?>