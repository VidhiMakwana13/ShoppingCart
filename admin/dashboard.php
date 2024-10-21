<?php
$mysqli = new mysqli("localhost", "root", "", "shoppingcart");
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); /* Warm gradient background */
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2); /* Deeper shadow for emphasis */
            text-align: center;
            transition: transform 0.3s ease; /* Animation on hover */
        }

        .container:hover {
            transform: scale(1.05); /* Slight zoom-in effect */
        }

        h1 {
            color: #ff5722; /* Bright orange for the header */
            font-size: 2.5em;
            margin-bottom: 25px;
        }

        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 20px; /* Larger spacing between links */
        }

        .nav-button {
            display: inline-block;
            padding: 15px 25px;
            background: linear-gradient(135deg, #42a5f5 0%, #478ed1 100%); /* Cool gradient for buttons */
            color: white;
            text-decoration: none;
            border-radius: 50px; /* More rounded corners */
            transition: background 0.3s, box-shadow 0.3s; /* Smooth hover effects */
            font-size: 18px;
            font-weight: bold;
        }

        .nav-button:hover {
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.5); /* Glowing shadow on hover */
        }

        .logout {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
        }

        .logout:hover {
            background: linear-gradient(135deg, #e53935 0%, #b71c1c 100%);
            box-shadow: 0 6px 20px rgba(244, 67, 54, 0.5); /* Glowing shadow for logout */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Admin Dashboard</h1>
        <nav class="nav-links">
            <a href="categories/manage_categories.php" class="nav-button">Manage Categories</a>
            <a href="products/manage_products.php" class="nav-button">Manage Products</a>
            <a href="logout.php" class="nav-button logout">Logout</a>
        </nav>
    </div>
</body>
</html>
>
