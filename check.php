<?php
include 'assets/core/connect.php';
$current_order = $_SESSION['order_id'];

$sql = "SELECT p.*, i.filename, op.quantity, op.price as order_price 
        FROM order_product op
        JOIN products p ON op.product_id = p.product_id
        JOIN images i ON p.image_id = i.image_id
        WHERE op.order_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $current_order);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);

$total_price = 0;
foreach ($rows as $row) {
    $total_price += ($row['order_price'] * $row['quantity']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/check.css">
    <title>Kiosk</title>
</head>

<body>
    <div id="header">
        <h1>IS THIS CORRECT?</h1>

    </div>
    <div id="content">
        <?php foreach ($rows as $row) { ?>
            <div class="item" data-base-price="<?= $row['order_price'] ?>">
                <img src="assets/img/<?= $row['filename'] ?>" alt="<?= $row['name'] ?>" class="item-img">
                <div class="name-price">
                    <h2><?= $row['name'] ?></h2>
                    <p>€<?= number_format($row['order_price'] * $row['quantity'], 2) ?></p>
                </div>
                <div class="detail-box">
                    <div class="description"><?= $row['description'] ?></div>
                    <div class="kcals"><?= $row['kcal'] ?> kcal</div>
                </div>
                <div class="amount-box">

                    <p class="amount-text"><?= $row['quantity'] ?></p>

                </div>
            </div>
        <?php } ?>
    </div>

    <div id="footer">
        <div id="footer-total">
            <img src="assets/img/co_logo.png" alt="" id="footer-logo">
            <h1>YOUR TOTAL</h1>
            <p>€<?= number_format($total_price, 2) ?></p>
        </div>
        <a id="verlaat" href="start.php">X exit</a>
        <a id="menu" href="cart.php">change order</a>
        <a id="bestel">pay</a>
    </div>
</body>

<script src="assets/js/cart.js"></script>
<script>
    
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector("#bestel").addEventListener("click", function () {
            console.log("Bestel clicked");
            fetch("update_order_status.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                }
            })
                .then(response => response.json())
                .then(data => {
                    console.log("Response:", data);
                    window.location.href = `paid.php?pickup=${data.pickup_number}`;
                })
                .catch(error => {
                    console.log("Error:", error);
                });
        });
    });
</script>

</html>