<?php
session_start();
include 'assets/core/connect.php';

$type = $_GET['type']; // Gets either 'dine_in' or 'take_out'

// Find first available order_id between 1 and 99
$sql = "SELECT order_id FROM orders WHERE order_id BETWEEN 1 AND 99 ORDER BY order_id";
$result = $conn->query($sql);

$used_ids = array();
while ($row = $result->fetch_assoc()) {
    $used_ids[] = $row['order_id'];
}

$new_order_id = 1;
for ($i = 1; $i <= 99; $i++) {
    if (!in_array($i, $used_ids)) {
        $new_order_id = $i;
        break;
    }
}

// Create new order with status 1 (Started)
$sql = "INSERT INTO orders (order_id, order_status_id) VALUES (?, 1)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $new_order_id);
$stmt->execute();

// Store order_id in session
$_SESSION['order_id'] = $new_order_id;

header("Location: menu.php");
exit();
?>