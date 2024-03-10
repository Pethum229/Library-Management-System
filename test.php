<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="test.css">
</head>
<body>
    <div class="header">
        <div class="navbar">
            <a href="#" class="logo">Library<span>System</span></a>
            <div class="menu">
                <a href="#">Home</a>
                <a href="#">About Us</a>
                <a href="#">Book Inventory</a>
                <a href="#">Contact Us</a>
            </div>
            <div class="auth-buttons">
                <a href="#" class="btn">Login</a>
                <a href="#" class="btn btn-primary">Register</a>
            </div>
        </div>
    </div>
    <div class="landing-page">
        <div class="overlay"></div>
        <div class="search-container">
            <h1>Welcome to Our Library</h1>
            <p>Find your next book:</p>
            <form action="#" method="GET">
                <input type="text" placeholder="Search books..." name="search">
                <button type="submit">Search</button>
            </form>
        </div>
        <!-- Trending Books Section Within Landing Page -->
        <div class="trending-books">
            <h2>Trending Books</h2>
            <div class="book-card">
                <div class="book-image">
                    <a href="#"><img src="book-image.jpg" alt="Book Name"></a>
                </div>
                <div class="book-info">
                    <a href="#" class="book-title">Book Name</a>
                    <p class="author-name">Author Name</p>
                    <p class="isbn">ISBN Number: 1234567890</p>
                    <p class="remaining-count">Remaining: 5</p>
                    <p class="trending-status">Trending!</p>
                    <button class="borrow-btn">Borrow</button>
                </div>
            </div>
            <!-- Repeat the .book-card for as many trending books as you want -->
        </div>
    </div>
</body>
</html>
