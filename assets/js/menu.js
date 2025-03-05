document.querySelector(".verlaat").addEventListener("click", function () {
  console.log("Verlaat clicked");
  fetch("./delete_order.php", {
    method: "POST",
  })
    .then((response) => response.text())
    .then((data) => {
      console.log("Delete response:", data);
      setTimeout(() => {
        window.location.href = "index.php";
      }, 1);
    })
    .catch((error) => {
      console.log("Error:", error);
    });
});

document.querySelector(".bestel").addEventListener("click", function () {
  window.location.href = "cart.php";
});
document.querySelector(".cart-image-container").addEventListener("click", function () {
  window.location.href = "cart.php";
});
document.querySelectorAll(".item-card").forEach((card) => {
  card.addEventListener("click", function () {
    const productId = this.dataset.productId;

    fetch("add_to_cart.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "product_id=" + productId,
    })
      .then((response) => response.text())
      .then((count) => {
        document.getElementById("cart-amount").textContent = count > 0 ? count : "";
      });
  });
});
