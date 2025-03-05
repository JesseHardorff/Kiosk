<?php
include 'assets/core/connect.php';

if(isset($_POST['product_id']) && isset($_SESSION['order_id']) && isset($_POST['action'])) {
    $product_id = $_POST['product_id'];
    $order_id = $_SESSION['order_id'];
    $action = $_POST['action'];

    if($action === 'increase') {
        $stmt = $conn->prepare("UPDATE order_product SET quantity = quantity + 1 WHERE order_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $order_id, $product_id);
        $stmt->execute();
    } else {
        // Get current quantity
        $stmt = $conn->prepare("SELECT quantity FROM order_product WHERE order_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $order_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $quantity = $result->fetch_assoc()['quantity'];

        if($quantity <= 1) {
            // Delete if going to 0
            $stmt = $conn->prepare("DELETE FROM order_product WHERE order_id = ? AND product_id = ?");
            $stmt->bind_param("ii", $order_id, $product_id);
            $stmt->execute();
            echo "0";
        } else {
            // Decrease quantity
            $stmt = $conn->prepare("UPDATE order_product SET quantity = quantity - 1 WHERE order_id = ? AND product_id = ?");
            $stmt->bind_param("ii", $order_id, $product_id);
            $stmt->execute();
            echo $quantity - 1;
        }
        return;
    }

    // Get and return new quantity
    $stmt = $conn->prepare("SELECT quantity FROM order_product WHERE order_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $order_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    echo $result->fetch_assoc()['quantity'];
}
?>
