<!-- categories.php -->
<?php
$mysqli = new mysqli("localhost", "root", "", "shoppingcart");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch categories
$categories = $mysqli->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fbc2eb, #a6c1ee); /* Soft pastel gradient */
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #673ab7; /* Purple for header */
            font-size: 2.5em;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        li {
            background: white;
            margin: 15px 0;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); /* Deeper shadow for a floating effect */
            width: 100%;
            max-width: 600px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s ease;
        }

        li:hover {
            transform: translateY(-5px) scale(1.03); /* Slight zoom and lift effect */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Increased shadow on hover */
        }

        a {
            text-decoration: none;
            color: #673ab7; /* Purple for links */
            font-size: 1.2em;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #311b92; /* Darker purple on hover */
        }

        /* Responsive design for smaller screens */
        @media (max-width: 600px) {
            li {
                padding: 15px;
            }

            a {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <h1>Categories</h1>
    <ul>
        <?php while ($category = $categories->fetch_assoc()): ?>
            <li>
                <a href="product_detail.php?category_id=<?= $category['id'] ?>">
                    <?= htmlspecialchars($category['name']) ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
