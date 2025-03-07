<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/paid-page.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Kiosk</title>

</head>

<body>
    <header class="kiosk-header">
        <div class="logo-container">
            <img src="assets/img/co_logo.png" alt="Logo" class="logo">
        </div>

    </header>
    <div class="thanks-container">
        Thanks for Ordering!
    </div>
    <div class="order-container">
        <div class="order-text">
            Please take the receipt and check the boards for your order status. Your order number is:
        </div>
        <div class="order-number">
            <?php echo $_GET['pickup']; ?>
        </div>

    </div>



</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            window.location.href = 'index.php';
        }, 7500);
    });
</script>

<!-- <script src="assets/js/choose-press.js"></script> -->

</html>