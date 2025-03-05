<?php
include_once 'assets/core/header.php';
include 'assets/core/connect.php';
echo "Current order ID: " . $_SESSION['order_id'];
$cat1 = isset($_GET['cat']) ? (int) $_GET['cat'] : 1; // 1 is default category
?>
<main>
    <div id="advert"></div>
    <div id="menu-welcomebar">
        <div class="logo-container">
            <img src="assets/img/co_logo.png" alt="logo" id="logo">
        </div>
        <p>WELCOME TO HAPPY HERBIVORE</p>
    </div>
    <div id="menu-container">
        <nav id="menu-sidebar">
            <ul>
                <?php
                $sqli_prepare = $conn->prepare("SELECT category_id, `name`, `description` FROM categories");
                if ($sqli_prepare === false) {
                    echo mysqli_error($conn);
                } else {
                    if ($sqli_prepare->execute()) {
                        $sqli_prepare->store_result();
                        $sqli_prepare->bind_result($category_id, $category_name, $category_description);
                        while ($sqli_prepare->fetch()) { // WHILE START            
                            ?>
                            <li class="category">
                                <a href="menu.php?cat=<?= $category_id ?>">
                                    <img src="assets/img/breakfast1.webp" alt="menu" class="category-icon">
                                    <p class="category-title"><?= $category_name ?></p>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    $sqli_prepare->close();
                }
                ?>
            </ul>
        </nav>
        <!-- </div> -->
        <div id="menu-items">
            <?php
            // First prepare the products query
            $sqli_prepare = $conn->prepare("
            SELECT p.product_id, p.image_id, p.name, p.price, i.filename 
            FROM products p
            JOIN images i ON p.image_id = i.image_id
            WHERE p.category_id = ?
        ");

            if ($sqli_prepare === false) {
                echo mysqli_error($conn);
            } else {
                $sqli_prepare->bind_param("i", $cat1);
                if ($sqli_prepare->execute()) {
                    $sqli_prepare->store_result();
                    $sqli_prepare->bind_result($product_id, $image_id, $product_name, $product_price, $image_filename);
                    while ($sqli_prepare->fetch()) {

                        ?>
                        <div class="item-card" data-product-id="<?= $product_id ?>">

                            <img src="assets/img/<?= $image_filename ?>" alt="menu" class="item-image">
                            <div class="item-info">
                                <p class="item-title"><?= $product_name ?></p>
                                <p class="item-price">€<?= $product_price ?></p>
                            </div>
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
                <div class="cart-image-container">
                    <img src="assets/img/cart.png" alt="cart">
                    <p id="cart-amount">##</p>
                </div>
            </div>
            <p id="cart-total">Your total: <br> €##,##</p>
        </div>
        <div id="footer-buttons">
            <div class="verlaat">X verlaat</div>
            <div class="bestel">Bestelling Afronden</div>
        </div>
    </div>
</main>
</body>
<script src="assets/js/menu.js"></script>

</html>