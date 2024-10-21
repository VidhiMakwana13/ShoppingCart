<?php
$mysqli = new mysqli("localhost", "root", "", "shoppingcart");
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
}

if (isset($_POST['add_category'])) {
    $name = $_POST['name'];
    $stmt = $mysqli->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->execute([$name]);
    header("Location: manage_categories.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
   <style>
    /* Reset some default styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body styling with a vibrant background gradient */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #FF7E5F, #FEB47B); /* Vibrant orange-pink gradient */
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
    }

    /* Container styling with shadow and rounded edges */
    .container {
        background-color: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        width: 100%;
    }

    /* Heading styling */
    h1 {
        text-align: center;
        color: #FF7E5F; /* Orange color matching the gradient */
        margin-bottom: 20px;
        font-size: 2.2em;
        font-weight: bold;
    }

    /* Category form styling */
    .category-form {
        display: flex;
        flex-direction: column;
    }

    .category-form input[type="text"] {
        padding: 12px;
        margin-bottom: 20px;
        border: 2px solid #FF7E5F;
        border-radius: 30px;
        font-size: 16px;
        color: #333;
        outline: none;
        transition: border-color 0.3s;
    }

    .category-form input[type="text"]:focus {
        border-color: #FEB47B;
    }

    /* Button styling with hover effect */
    .category-form button {
        padding: 12px;
        background-color: #FF7E5F;
        color: white;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .category-form button:hover {
        background-color: #FE6B4B; /* Darker orange for hover */
    }

    /* Back link styling */
    .back-link {
        display: block;
        text-align: center;
        margin-top: 20px;
        color: #FF7E5F;
        text-decoration: none;
        font-size: 16px;
        font-weight: bold;
        transition: color 0.3s;
    }

    .back-link:hover {
        color: #FE6B4B; /* Darker orange on hover */
    }

    /* Responsive styling */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h1 {
            font-size: 1.8em;
        }

        .category-form input[type="text"], .category-form button {
            font-size: 14px;
        }
    }
   </style>
</head>
<body>
    <div class="container">
        <h1>Add New Category</h1>
        <form method="post" class="category-form">
            <input type="text" name="name" placeholder="Category Name" required />
            <button type="submit" name="add_category">Add Category</button>
        </form>
        <a href="manage_categories.php" class="back-link">Back to Manage Categories</a>
    </div>
</body>
</html>
