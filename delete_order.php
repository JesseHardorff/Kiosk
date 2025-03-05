<?php
include 'assets/core/connect.php';

var_dump($_SESSION);  // See what's in session
var_dump($_SESSION['order_id']); // Check specific order_id

if (isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id'];
    echo "Attempting to delete order: " . $order_id;

    // First delete from order_product
    $stmt = $conn->prepare("DELETE FROM order_product WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $result1 = $stmt->execute();
    echo "Order product delete result: " . ($result1 ? 'success' : 'fail');

    // Then delete from orders
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $result2 = $stmt->execute();
    echo "Order delete result: " . ($result2 ? 'success' : 'fail');

    unset($_SESSION['order_id']);
}
?>