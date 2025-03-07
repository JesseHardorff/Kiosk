<?php
include 'assets/core/connect.php';

// Controleer of product_id en order_id bestaan
if (isset($_POST['product_id']) && isset($_SESSION['order_id'])) {
    $product_id = $_POST['product_id'];
    $order_id = $_SESSION['order_id'];

    // Controleer of product al in bestelling zit
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM order_product WHERE order_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $order_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->fetch_assoc()['count'];

    if ($exists > 0) {
        // Verhoog aantal als product al bestaat
        $stmt = $conn->prepare("UPDATE order_product SET quantity = quantity + 1 WHERE order_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $order_id, $product_id);
    } else {
        // Voeg nieuw product toe met prijs uit products tabel
        $stmt = $conn->prepare("INSERT INTO order_product (order_id, product_id, quantity, price)
                              SELECT ?, ?, 1, price
                              FROM products
                              WHERE product_id = ?");
        $stmt->bind_param("iii", $order_id, $product_id, $product_id);
    }
    $stmt->execute();
}
?>