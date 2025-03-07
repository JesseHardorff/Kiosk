<?php
include 'assets/core/connect.php';

// Controleer of alle benodigde waardes aanwezig zijn
if (isset($_POST['product_id']) && isset($_SESSION['order_id']) && isset($_POST['action'])) {
    $product_id = $_POST['product_id'];
    $order_id = $_SESSION['order_id'];
    $action = $_POST['action'];

    // Als de actie 'verhogen' is
    if ($action === 'increase') {
        $stmt = $conn->prepare("UPDATE order_product SET quantity = quantity + 1 WHERE order_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $order_id, $product_id);
        $stmt->execute();
    } else {
        // Haal huidige aantal op
        $stmt = $conn->prepare("SELECT quantity FROM order_product WHERE order_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $order_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $quantity = $result->fetch_assoc()['quantity'];

        // Als aantal 1 of minder is
        if ($quantity <= 1) {
            // Verwijder product uit bestelling
            $stmt = $conn->prepare("DELETE FROM order_product WHERE order_id = ? AND product_id = ?");
            $stmt->bind_param("ii", $order_id, $product_id);
            $stmt->execute();
            echo "0";
        } else {
            // Verlaag aantal met 1
            $stmt = $conn->prepare("UPDATE order_product SET quantity = quantity - 1 WHERE order_id = ? AND product_id = ?");
            $stmt->bind_param("ii", $order_id, $product_id);
            $stmt->execute();
            echo $quantity - 1;
        }
        return;
    }

    // Haal nieuwe aantal op en stuur terug
    $stmt = $conn->prepare("SELECT quantity FROM order_product WHERE order_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $order_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo $result->fetch_assoc()['quantity'];
}
?>