<?php
include ('assets/core/connect.php');
// random getal van 1 tot 29(alle producten) voor de de reclame image die om 5 sec verandert

$randomProductId = rand(1, 29);

// pak de image_id en andere info die ik bij het product wil laten zien van dit getal in de products table
$sql = "SELECT image_id, name, price, kcal FROM products WHERE product_id = $randomProductId";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

// pak de filename van deze image_id in de images table
$sql = "SELECT filename FROM images WHERE image_id = " . $product['image_id'];
$result = $conn->query($sql);
$filename = $result->fetch_assoc()['filename'];

echo "assets/img/" . $filename . "||" . 
     $product['name'] . "||" . 
     $product['price'] . "||" . 
     $product['kcal'];
     

?>