<?php
$mysqli = new mysqli("localhost", "root", "", "shoppingcart");
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
}

$id = $_GET['id'];
$stmt = $mysqli->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);
header("Location: manage_products.php");
?>
