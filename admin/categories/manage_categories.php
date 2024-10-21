<?php
$mysqli = new mysqli("localhost", "root", "", "shoppingcart");
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

// Query to get all categories
$result = $mysqli->query("SELECT * FROM categories");
$categories = []; // Array to hold categories
while ($row = $result->fetch_assoc()) {
    $categories[] = $row; // Add each category to the array
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <style>
        /* Resetting margins and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling with a gradient background */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #74EBD5, #ACB6E5); /* Soft teal to light purple gradient */
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Main container styling */
        .container {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            max-width: 900px;
            width: 100%;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 28px;
            color: #6A82FB; /* Cool blue color */
            margin-bottom: 25px;
            font-weight: bold;
        }

        .btn {
            padding: 12px 25px;
            background-color: #6A82FB; /* Blue button */
            color: white;
            border: none;
            border-radius: 30px;
            text-decoration: none;
            font-size: 16px;
            margin-bottom: 20px;
            display: inline-block;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn:hover {
            background-color: #74EBD5; /* Lighter blue on hover */
            transform: translateY(-2px); /* Lift effect on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #f2f2f2;
            color: #555;
            font-weight: 600;
        }

        td {
            background-color: #fff;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9; /* Alternating row color */
        }

        /* Styling action buttons inside the table */
        .action-btn {
            padding: 10px 15px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 14px;
            color: white;
            margin-right: 5px;
            display: inline-block;
            transition: background-color 0.3s, transform 0.3s;
        }

        .edit {
            background-color: #4CAF50; /* Green for edit button */
        }

        .edit:hover {
            background-color: #45a049; /* Darker green on hover */
            transform: scale(1.05); /* Slight zoom effect */
        }

        .delete {
            background-color: #f44336; /* Red for delete button */
        }

        .delete:hover {
            background-color: #e53935; /* Darker red on hover */
            transform: scale(1.05); /* Slight zoom effect */
        }

        .back {
            background-color: #2196F3; /* Blue for back button */
        }

        .back:hover {
            background-color: #1976D2; /* Darker blue on hover */
            transform: scale(1.05); /* Slight zoom effect */
        }

        /* Responsive design for mobile devices */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            table, th, td {
                font-size: 14px;
                padding: 10px;
            }

            .btn {
                font-size: 14px;
                padding: 10px 20px;
            }

            .action-btn {
                font-size: 12px;
                padding: 8px 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Categories</h1>
        <a href="add_category.php" class="btn">Add New Category</a>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?= htmlspecialchars($category['name']) ?></td>
                        <td>
                            <a href="edit_category.php?id=<?= $category['id'] ?>" class="action-btn edit">Edit</a>
                            <a href="delete_category.php?id=<?= $category['id'] ?>" class="action-btn delete">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../dashboard.php" class="btn back">Back to Dashboard</a>
    </div>
</body>
</html>
