<?php
session_start();
include 'assets/core/connect.php';

// Haal het type bestelling op (dine_in of take_out)
$type = $_GET['type'];

// Zoek het eerste beschikbare order_id tussen 1 en 99
$sql = "SELECT order_id FROM orders WHERE order_id BETWEEN 1 AND 99 ORDER BY order_id";
$result = $conn->query($sql);

// Maak een array van gebruikte order_ids
$used_ids = array();
while ($row = $result->fetch_assoc()) {
    $used_ids[] = $row['order_id'];
}

// Zoek het eerste vrije nummer
$new_order_id = 1;
for ($i = 1; $i <= 99; $i++) {
    if (!in_array($i, $used_ids)) {
        $new_order_id = $i;
        break;
    }
}

// Maak nieuwe bestelling aan met status 1 (Gestart)
$sql = "INSERT INTO orders (order_id, order_status_id) VALUES (?, 1)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $new_order_id);
$stmt->execute();

// Sla order_id op in sessie
$_SESSION['order_id'] = $new_order_id;

// Stuur door naar menu pagina
header("Location: menu.php");
exit();
?>
