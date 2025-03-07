<?php
include 'assets/core/connect.php';

// Controleer of product_id en order_id bestaan
if (isset($_POST['product_id']) && isset($_SESSION['order_id'])) {
    $product_id = $_POST['product_id'];
    $order_id = $_SESSION['order_id'];

    // Verwijder één exemplaar van het product uit de bestelling
    $stmt = $conn->prepare("DELETE FROM order_product WHERE order_id = ? AND product_id = ? LIMIT 1");
    $stmt->bind_param("ii", $order_id, $product_id);
    $stmt->execute();

    // Tel hoeveel er nog over zijn van dit product
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM order_product WHERE order_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $order_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->fetch_assoc()['count'];

    // Stuur aantal terug
    echo $count;
}
?>
