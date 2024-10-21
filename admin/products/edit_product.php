<?php
$mysqli = new mysqli("localhost", "root", "", "shoppingcart");
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
}

$id = $_GET['id'];
$stmt = $mysqli->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (isset($_POST['edit_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    // Handle image upload
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "../upload/product_images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $product['image']; // Keep the existing image if no new one is uploaded
    }

    $stmt = $mysqli->prepare("UPDATE products SET name = ?, price = ?, category_id = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sdisi", $name, $price, $category_id, $image, $id);
    $stmt->execute();
    header("Location: manage_products.php");
}

$categories = $mysqli->query("SELECT * FROM categories");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        /* style.css */

body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(to right, #e3f2fd, #bbdefb); /* Light gradient background */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: white;
    border-radius: 12px; /* More rounded corners */
    padding: 30px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2); /* Deeper shadow for depth */
    width: 400px; /* Fixed width for consistency */
}

h1 {
    color: #3F51B5; /* Deep blue for the header */
    text-align: center;
    margin-bottom: 25px; /* Increased margin for spacing */
    font-size: 2.5em; /* Larger header */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* Subtle text shadow */
}

form {
    display: flex;
    flex-direction: column;
}

input[type="text"], 
input[type="number"], 
select, 
input[type="file"] {
    padding: 12px; /* Increased padding for a more spacious feel */
    margin-bottom: 20px; /* Increased bottom margin for spacing */
    border: 1px solid #ccc; /* Light grey border */
    border-radius: 6px; /* Rounded corners */
    font-size: 16px;
    width: 100%;
    transition: border-color 0.3s; /* Smooth border transition */
}

input[type="text"]:focus, 
input[type="number"]:focus, 
select:focus {
    border-color: #3F51B5; /* Change border color on focus */
    outline: none; /* Remove outline */
}

button {
    padding: 12px; /* Increased padding */
    background: linear-gradient(to right, #4CAF50, #45a049); /* Gradient background for buttons */
    color: white;
    border: none;
    border-radius: 6px; /* More rounded corners */
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s; /* Smooth transition */
}

button:hover {
    background: linear-gradient(to right, #45a049, #4CAF50); /* Reverse gradient on hover */
    transform: translateY(-2px); /* Lift effect on hover */
}

a {
    display: inline-block;
    margin-top: 15px;
    text-align: center;
    text-decoration: none;
    color: #2196F3; /* Link color */
    font-size: 14px;
    transition: color 0.3s; /* Smooth transition for hover */
}

a:hover {
    color: #1976D2; /* Darker blue on hover */
}


    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Product</h1>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" placeholder="Product Name" required />
            <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" placeholder="Product Price" required />
            <select name="category_id" required>
                <?php while ($category = $categories->fetch_assoc()) : ?>
                    <option value="<?= $category['id'] ?>" <?= ($category['id'] == $product['category_id']) ? 'selected' : '' ?>><?= htmlspecialchars($category['name']) ?></option>
                <?php endwhile; ?>
            </select>
            <input type="file" name="image" />
            <button type="submit" name="edit_product">Update Product</button>
        </form>
        <a href="manage_products.php">Back to Manage Products</a>
    </div>
</body>
</html>
