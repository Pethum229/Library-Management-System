<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Import Bootrstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Admin Portal</title>
</head>
<body>
    <section>
        <div>
            <button><a href="/Library-Management-System/Admin Portal/dashboard.php">Dashboard</a></button>
            <button><a href="/Library-Management-System/Admin Portal/Manage Books/books.php">Manage Books</a></button>
            <button><a href="/Library-Management-System/Admin Portal/Manage Users/users.php">Manage Users</a></button>
            <button><a href="/Library-Management-System/Admin Portal/Lending Transactions/transactions.php">Lending Transactions</a></button>
            <button><a href="/Library-Management-System/Admin Portal/settings.php">Settings</a></button>
            <button><a href="/Library-Management-System/Login&Register/logout.php">Log Out</a></button>
        </div>
    </section>