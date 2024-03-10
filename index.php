<!-- Include Header -->
<?php
    include_once "Common/inc_header.php";
?>
    <style>
        /* Landing CSS <---Start---> */

        .landing {
            background-image: url('images/BGImg.jpg');
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
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
        }

        .search {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 90%;
            max-width: 600px;
        }

        .search h1 {
            margin-bottom: 20px;
            font-size: 2.5em;
        }

        .search p {
            margin-bottom: 20px;
            font-size: 1.2em;
        }

        .search form {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .search input[type="text"] {
            width: 70%;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        .search button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search button:hover {
            background-color: #45a049;
        }

        /* Landing CSS <---End---> */

    </style>

    <!-- Landing Page Design <-Start->-->

    <div class="landing">
        <div class="overlay"></div>
        <div class="search">
            <h1>Welcome to Our Library</h1>
            <p>Find your next book:</p>
            <form action="">
                <input type="text" placeholder="Seach books..." name="search">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <!-- Landing Page Design <-End->-->

<!-- Include Footer -->
<?php
    include_once "Common/inc_footer.php";
?>