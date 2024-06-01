<?php
// Fetch data from the API
include 'navbar.php'; 
  
  include("db.php");
	include("function.php");
  
  check_login($con);
$json_data = file_get_contents('https://fakestoreapi.com/products');

// Decode JSON data into a PHP array
$products = json_decode($json_data, true);

// Sort products by name in ascending order
usort($products, function ($a, $b) {
    return strcmp($a['title'], $b['title']);
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        .search-bar {
            margin: 20px;
            text-align: center;
        }
        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
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
    <script>
        function filterProducts() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                const title = product.querySelector('.product-title').innerText.toLowerCase();
                if (title.includes(query)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }
    </script>
</head>
<body>
    <h1>Product List</h1>
    <div class="search-bar">
        <input type="text" id="searchInput" onkeyup="filterProducts()" placeholder="Search for products...">
    </div>
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
