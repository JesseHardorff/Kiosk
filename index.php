<?php
include 'assets/core/connect.php';
// Random getal tussen 1 en 29 (product_id) voor 1ste foto
$randomProductId = rand(1, 29);

// pak de image_id en andere info die ik bij het product wil laten zien van dit getal in de products table
$sql = "SELECT image_id, name, price, kcal FROM products WHERE product_id = $randomProductId";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
$imageId = $product['image_id'];
$name = $product['name'];
$price = $product['price'];
$kcal = $product['kcal'];

// pak de filename van deze image_id in de images table
$sql = "SELECT filename FROM images WHERE image_id = $imageId";
$result = $conn->query($sql);
$filename = $result->fetch_assoc()['filename'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/ad-page.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Kiosk</title>

</head>

<body>
    <header class="kiosk-header">
        <div class="logo-container">
            <img src="assets/img/logo.png" alt="Logo" class="logo">
        </div>
        <div class="header-text">
            <h1>Welcome to Happy Herbivore</h1>
            <p>Healthy in a Hurry!</p>
        </div>
    </header>
    <div class="ad-overlay">

        <div class="ad-product-container">

            <div class="ad-title-product-container">
                <span class="product-name"><?php echo $name; ?></span>
                <span class="product-kcal"><?php echo $kcal; ?> kcal</span>
            </div>

            <div class="ad-image-product-container">
                <img src="assets/img/<?php echo $filename; ?>" alt="Random Product" class="ad-product-image">
            </div>

            <div class="ad-price-product-container">
                <span class="product-price">€<?php echo number_format($price, 2); ?></span>
            </div>

        </div>

    </div>


</body>
<script src="assets/js/fade.js"></script>
<script src="assets/js/start-press.js"></script>

</html>