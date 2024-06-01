<?php
session_start();
include 'navbar.php'; 
    include("db.php");
	include("function.php");
  
    check_login($con);
  


$json_data = file_get_contents('https://fakestoreapi.com/products');

// Decode JSON data into a PHP array
$products = json_decode($json_data, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            width: 200px;
            text-align: center;
        }
        .product-img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .product-title {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
        .product-price {
            color: green;
            margin: 10px 0;
        }
        .product-description {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>Product List</h1>
    <div class="product-container">
        <?php
        // Loop through each product and display its details
        foreach ($products as $product) {
            echo '<div class="product-card">';
            echo '<img src="' . $product['image'] . '" alt="Product Image" class="product-img">';
            echo '<p class="product-title">' . $product['title'] . '</p>';
            echo '<p class="product-price">$' . $product['price'] . '</p>';
            echo '<p class="product-description">' . $product['description'] . '</p>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
