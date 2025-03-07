<?php
include 'assets/core/connect.php';

// Controleer of er een actieve bestelling is
if (isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id'];

    // Verwijder de bestelling (order_product wordt automatisch verwijderd door foreign key)
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    // Verwijder order_id uit de sessie
    unset($_SESSION['order_id']);
    echo "success";
}
?>
