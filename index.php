<?php
include ('assets/core/connect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <?php
// random getal van 1 tot 29(alle producten)
$randomProductId = rand(1, 29);

// pak de image_id van dit getal in de products table
$sql = "SELECT image_id FROM products WHERE product_id = $randomProductId";
$result = $conn->query($sql);
$imageId = $result->fetch_assoc()['image_id'];

// pak de filename van deze image_id in de images table
$sql = "SELECT filename FROM images WHERE image_id = $imageId";
$result = $conn->query($sql);
$filename = $result->fetch_assoc()['filename'];

echo "assets/img/" . $filename;
?>


<div class="ad-image-container">
    <img src="assets/img/<?php echo $filename; ?>" alt="Random Product" class="ad-product-image">
</div>


</body>
<script src="assets/js/fade.js"></script>
</html>