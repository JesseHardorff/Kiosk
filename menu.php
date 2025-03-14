<?php
include_once 'assets/core/header.php';
include 'assets/core/connect.php';

$cat1 = isset($_GET['cat']) ? (int) $_GET['cat'] : 1; // 1 is default category
?>
<main>
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
                            <li class="menu-category" id="category<?= $category_id ?>"
                                onclick="changeCategory(<?= $category_id ?>)">
                                <img src="assets/img/<?= $category_description ?>1.webp" alt="menu" class="category-icon">
                                <p class="category-title"><?= $category_name ?></p>
                                <!-- </a> -->
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
            SELECT p.product_id, p.image_id, p.name, p.price, i.filename, p.category_id 
            FROM products p
            JOIN images i ON p.image_id = i.image_id
        ");

            if ($sqli_prepare === false) {
                echo mysqli_error($conn);
            } else {
                if ($sqli_prepare->execute()) {
                    $sqli_prepare->store_result();
                    $sqli_prepare->bind_result($product_id, $image_id, $product_name, $product_price, $image_filename, $category_id);
                    while ($sqli_prepare->fetch()) {

                        ?>
                        <div class="item-card inactive category<?= $category_id ?>" id="item-card<?= $product_id ?>"
                            data-product-id="<?= $product_id ?>">
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
            <p id="cart-total">€<?= number_format($total_price, 2) ?></p>

        </div>
        <div id="footer-buttons">
            <div class="verlaat">X exit</div>
            <div class="bestel">Finish Ordering</div>
        </div>
    </div>
</main>
</body>
<script src="assets/js/menu.js"></script>
<script src="assets/js/category.js"></script>
<script src="assets/js/cart.js"></script>
<script>
    // Set the initial active category
    document.addEventListener('DOMContentLoaded', function () {
        changeCategory(<?= $cat1 ?>);
    });
</script>

</html>