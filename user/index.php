<?php
$mysqli = new mysqli("localhost", "root", "", "shoppingcart");
session_start();

// Fetch all categories
$result = $mysqli->query("SELECT * FROM categories");
$categories = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Shopping Cart</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #FFDEE9, #B5FFFC); /* Soft pink and blue gradient */
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background: linear-gradient(135deg, #f093fb, #f5576c); /* Vibrant gradient for header */
            color: white;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin: 0;
            font-size: 2.5em;
            text-transform: uppercase;
        }

        .user-actions {
            margin-top: 15px;
        }

        .user-actions a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 16px;
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.1);
            transition: background-color 0.3s ease;
        }

        .user-actions a:hover {
            background-color: rgba(255, 255, 255, 0.3); /* Softer background on hover */
        }

        main {
            padding: 40px;
        }

        .categories {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            padding-top: 20px;
        }

        .category {
            background: white;
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            padding: 25px;
            transition: transform 0.3s, box-shadow 0.3s ease;
            text-align: center;
            position: relative;
        }

        .category:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .category h2 {
            font-size: 1.8em;
            margin-bottom: 15px;
            color: #673ab7; /* Deep purple for category titles */
        }

        .category a {
            display: inline-block;
            padding: 12px 20px;
            background-color: #FF6B6B; /* Bright coral button */
            color: white;
            border-radius: 50px;
            text-decoration: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .category a:hover {
            background-color: #FF4D4D; /* Darker coral on hover */
            box-shadow: 0 4px 10px rgba(255, 75, 75, 0.3);
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .categories {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Shopping Cart</h1>
        <nav class="user-actions">
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <div class="categories">
            <?php foreach ($categories as $category) : ?>
                <div class="category">
                    <h2><?= htmlspecialchars($category['name']) ?></h2>
                    <a href="category.php?id=<?= $category['id'] ?>">View Products</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>
