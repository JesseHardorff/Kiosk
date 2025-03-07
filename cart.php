<?php

include 'assets/core/connect.php';

$current_order = $_SESSION['order_id'];

// Get all products in current order with their details
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



$sql = "SELECT COUNT(*) as count FROM order_product WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $current_order);
$stmt->execute();
$result = $stmt->get_result();
$count = $result->fetch_assoc()['count'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/cart.css">
    <title>Kiosk</title>
</head>

<body>
    <div id="advert-cart">
        <div id="advert">
            <img src="assets/img/sides3.webp" alt="advert" id="advert-img">
            <p id="advert-title">Mini Veggie Platter</p>
            <p id="advert-description">A selection of carrot sticks, celery, cucumber slices, and cherry tomatoes served
                with a dip of your choice.</p>
            <div id="advert-price-container">
                <p id="advert-price">€3.00</p>
                <p id="advert-kcal">150 kcal</p>
            </div>
        </div>
        <div id="cart">
            <div id="cart-image"></div>
            <img>
            <p><?php
            $total_items = 0;
            foreach ($rows as $row) {
                $total_items += $row['quantity'];
            }
            echo $total_items;
            ?></p>
        </div>

    </div>

    <div id="header">
        <h1>YOUR ORDER</h1>
        <p id="total-price">€<?= number_format($total_price, 2) ?></p>


    </div>
    <div id="content">
        <?php if ($count == 0) { ?>
            <div id="empty-cart-message" style="color: red; text-align: center;">
                You don't have anything in your cart
            </div>
        <?php } else { ?>
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
                        <button class="amount-minus">-</button>
                        <p class="amount-text"><?= $row['quantity'] ?></p>

                        <button class="amount-plus">+</button>
                        <button class="amount-clear" data-product-id="<?= $row['product_id'] ?>">X</button>

                    </div>
                </div>

            <?php }
        } ?>
    </div>
    <div id="footer">
        <a class="verlaat" href="start.php">X exit</a>
        <a id="menu" href="menu.php">back to menu</a>
        <?php if ($count > 0) { ?>
            <a id="bestel2" href="check.php">order</a>
        <?php } else { ?>
            <a id="bestel2" style="pointer-events: none; opacity: 0.5;">order</a>
        <?php } ?>
    </div>

</body>
<script src="assets/js/cart.js"></script>


</html>