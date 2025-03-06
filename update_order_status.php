<?php
include 'assets/core/connect.php';

// Get latest pickup number
$sql = "SELECT MAX(pickup_number) as max_pickup FROM orders WHERE pickup_number < 99";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$new_pickup = ($row['max_pickup'] ?? 0) + 1;
if ($new_pickup > 99) $new_pickup = 1;

// Get total price
$sql = "SELECT SUM(quantity * price) as total FROM order_product WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['order_id']);
$stmt->execute();
$total = $stmt->get_result()->fetch_assoc()['total'];

// Update order
$sql = "UPDATE orders SET 
        order_status_id = 2,
        pickup_number = ?,
        price = ?,
        datetime = CURRENT_TIMESTAMP
        WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("idi", $new_pickup, $total, $_SESSION['order_id']);
$stmt->execute();

echo json_encode(['pickup_number' => $new_pickup]);
?>
