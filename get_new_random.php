<?php
include('assets/core/connect.php');

// Genereer een willekeurig product ID tussen 1 en 29 voor de reclame afbeelding
$randomProductId = rand(1, 29);

// Haal product informatie op uit de database
$sql = "SELECT image_id, name, price, kcal FROM products WHERE product_id = $randomProductId";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

// Haal de bestandsnaam van de afbeelding op
$sql = "SELECT filename FROM images WHERE image_id = " . $product['image_id'];
$result = $conn->query($sql);
$filename = $result->fetch_assoc()['filename'];

// Stuur alle product informatie terug gescheiden door ||
echo "assets/img/" . $filename . "||" .
     $product['name'] . "||" .
     $product['price'] . "||" .
     $product['kcal'];
?>