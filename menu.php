<?php 
    include_once 'assets/core/header.php'; 
    include ('assets/core/connect.php');
    $cat1 = 6;
?>
<main>
    <div id="advert"></div>
    <div id="menu-welcomebar">
        <img src="assets/img/logo.png" alt="logo" id="logo">
        <p>WELCOME TO HAPPY HERBIVORE</p>
    </div>
    <div id="menu-container">
        <nav id="menu-sidebar">
            <ul>
                <li class="menu-category">
                    <img src="assets/img/breakfast1.webp" alt="menu" class="category-icon">
                    <p class="category-title">BREAKFAST</p>
                </li>
                <li class="menu-category">
                    <img src="assets/img/breakfast1.webp" alt="menu" class="category-icon">
                    <p class="category-title">BREAKFAST</p>
                </li>
                <li class="menu-category">
                    <img src="assets/img/breakfast1.webp" alt="menu" class="category-icon">
                    <p class="category-title">BREAKFAST</p>
                </li>
                <li class="menu-category">
                    <img src="assets/img/breakfast1.webp" alt="menu" class="category-icon">
                    <p class="category-title">BREAKFAST</p>
                </li>
                <li class="menu-category">
                    <img src="assets/img/breakfast1.webp" alt="menu" class="category-icon">
                    <p class="category-title">BREAKFAST</p>
                </li>
                <li class="menu-category">
                    <img src="assets/img/breakfast1.webp" alt="menu" class="category-icon">
                    <p class="category-title">BREAKFAST</p>
                </li>
            </ul>
        </nav>
        <!-- </div> -->
        <div id="menu-items">
        <?php 
                $sqli_prepare = $conn->prepare("SELECT image_id, `name`, `description`, price, kcal FROM products WHERE category_id = ?");
                if ($sqli_prepare === false) {
                    echo mysqli_error($con);
                } else {
                    $sqli_prepare->bind_param("i", $cat1);
                    if ($sqli_prepare->execute()) {
                        $sqli_prepare->store_result();
                        $sqli_prepare->bind_result($image_id, $product_name, $product_description, $product_price, $product_kcal);
                        while ($sqli_prepare->fetch()) { // WHILE START            
            ?>
            <div class="item-card">
                <img src="assets/img/breakfast1.webp" alt="menu" class="item-image">
                <p class="item-title"><?= $product_name ?></p>
                <p class="item-price"><?= $product_price ?></p>
            </div>
            <?php
                        }
                    }
                    $sqli_prepare->close();
                }
            ?>
        </div>
    </div>
    <div id="footer">
        <div id="cart-container">
            <div id="cart-img">
                <img src="assets/img/dips1.webp" alt="cart">
                <p id="cart-amount">##</p>
            </div>
            <p id="cart-total">Your total: <br> €##,##</p>
        </div>
        <div id="footer-buttons">
            <button id="verlaat">X verlaat</button>
            <button id="bestel">Bestelling Afronden</button>
        </div>
    </div>
</main>