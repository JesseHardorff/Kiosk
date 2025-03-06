<?php
include 'assets/core/connect.php';

if (isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id'];

    // Delete from orders - order_product will be deleted automatically
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    unset($_SESSION['order_id']);
    echo "success";
}
?>