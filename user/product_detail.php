<!-- products.php -->
<?php
$mysqli = new mysqli("localhost", "root", "", "shoppingcart");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        /* Reset margin and padding for all elements */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #7b4397, #dc2430); /* Deep purple to red gradient */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #fff;
        }

        /* Container for products */
        .container {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
            margin-top: 20px;
        }

        /* Header style */
        h1 {
            text-align: center;
            color: #FFEB3B; /* Bright yellow */
            font-size: 2.5em;
            margin-bottom: 30px;
        }

        /* Product list grid layout */
        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Adjusted for more space */
            gap: 25px;
        }

        /* Individual product card */
        .product {
            background: white;
            border-radius: 15px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Product image styles */
        .product img {
            max-width: 100%;
            height: 200px;
            object-fit: cover; /* Ensure image fits without stretching */
            border-radius: 10px;
        }

        /* Product title */
        .product h2 {
            font-size: 1.5em;
            color: #333;
            margin: 15px 0;
        }

        /* Price styles */
        .product .price {
            font-size: 1.2em;
            color: #e91e63; /* Pink price */
            font-weight: bold;
        }

        /* Hover effect on product card */
        .product:hover {
            transform: translateY(-5px); /* Lift the card on hover */
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        /* Pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        /* Pagination button styles */
        .pagination-button {
            padding: 12px 20px;
            background-color: #ff6b6b; /* Coral */
            color: white;
            border: none;
            border-radius: 50px; /* Rounded button */
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
            margin: 0 5px;
        }

        /* Hover effect on pagination buttons */
        .pagination-button:hover:not([disabled]) {
            background-color: #ff4757; /* Darker coral */
        }

        /* Disabled button styles */
        .pagination-button[disabled] {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Media queries for responsiveness */
        @media (max-width: 768px) {
            .product-list {
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); /* Smaller for mobile */
            }

            .container {
                padding: 10px;
            }

            h1 {
                font-size: 2em;
            }
        }

    </style>
</head>
<body>
    <h1>Our Products</h1>
    <div class="container">
        <div class="product-list" id="product-list"></div>
        <div id="pagination" class="pagination"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let currentPage = 1;

        function loadProducts(page) {
            $.ajax({
                url: 'fetch_products.php',
                type: 'GET',
                data: {
                    category_id: <?= $category_id ?>,
                    page: page
                },
                dataType: 'json',
                success: function(response) {
                    $('#product-list').empty();
                    response.products.forEach(function(product) {
                        $('#product-list').append(`
                            <div class="product">
                                <h2>${product.name}</h2>
                                <p class="price">$${product.price}</p>
                                <img src=" ./assets/images/${product.image}" alt="${product.name}">
                            </div>
                        `);
                    });
                    renderPagination(response.total_pages, page);
                },
                error: function(xhr, status, error) {
                    console.error("Error: ", error);
                }
            });
        }

        function renderPagination(totalPages, currentPage) {
            $('#pagination').empty();
            for (let i = 1; i <= totalPages; i++) {
                $('#pagination').append(`
                    <button class="pagination-button" onclick="changePage(${i})" ${i === currentPage ? 'disabled' : ''}>${i}</button>
                `);
            }
        }

        function changePage(page) {
            currentPage = page;
            loadProducts(page);
        }

        $(document).ready(function() {
            loadProducts(currentPage);
        });
    </script>
</body>
</html>
