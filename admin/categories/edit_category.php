<?php
$mysqli = new mysqli("localhost", "root", "", "shoppingcart");
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
}

$id = $_GET['id'];
$stmt = $mysqli->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$category = $result->fetch_assoc();

if (isset($_POST['edit_category'])) {
    $name = $_POST['name'];
    $stmt = $mysqli->prepare("UPDATE categories SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();
    header("Location: manage_categories.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling with a modern gradient background */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74EBD5, #9FACE6); /* Soft teal to purple gradient */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        /* Container styling */
        .container {
            background-color: #fff;
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            font-size: 26px;
            color: #6A82FB; /* Soft blue color */
            margin-bottom: 25px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 15px;
            margin: 15px 0;
            border: 2px solid #6A82FB;
            border-radius: 30px;
            font-size: 16px;
            color: #333;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #74EBD5; /* Lighter border on focus */
            outline: none;
        }

        button {
            padding: 12px 25px;
            background-color: #6A82FB; /* Button matches the header color */
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #74EBD5; /* Lighter blue on hover */
        }

        a {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #6A82FB;
            font-size: 14px;
            transition: color 0.3s;
        }

        a:hover {
            color: #4D67EA; /* Darker shade on hover */
        }

        /* Responsive design for smaller devices */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
                margin: 20px;
            }

            h1 {
                font-size: 22px;
            }

            button {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Category</h1>
        <form method="post">
            <input type="text" name="name" value="<?= htmlspecialchars($category['name']) ?>" required />
            <button type="submit" name="edit_category">Update Category</button>
        </form>
        <a href="manage_categories.php">Back to Manage Categories</a>
    </div>
</body>
</html>
