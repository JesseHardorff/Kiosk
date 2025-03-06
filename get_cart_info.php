<?php
include 'assets/core/connect.php';
$current_order = $_SESSION['order_id'];

$sql = "SELECT SUM(quantity) as count, SUM(quantity * price) as total 
        FROM order_product 
        WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $current_order);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

echo json_encode([
    'count' => $row['count'] ?: 0,
    'total' => $row['total'] ?: 0
]);
