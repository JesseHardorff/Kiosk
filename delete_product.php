<?php
include 'assets/core/connect.php';

if (isset($_POST['product_id']) && isset($_SESSION['order_id'])) {
    $product_id = $_POST['product_id'];
    $order_id = $_SESSION['order_id'];

    // Delete only one instance using LIMIT 1
    $stmt = $conn->prepare("DELETE FROM order_product WHERE order_id = ? AND product_id = ? LIMIT 1");
    $stmt->bind_param("ii", $order_id, $product_id);
    $stmt->execute();

    // Get remaining count of this product
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM order_product WHERE order_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $order_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->fetch_assoc()['count'];

    echo $count;
}
?>