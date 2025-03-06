
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

function updateMenuCartInfo() {
  fetch("get_cart_info.php")
    .then((response) => response.json())
    .then((data) => {
      document.querySelector("#cart-amount").textContent = data.count;
      const total = parseFloat(data.total);
      document.querySelector("#cart-total").innerHTML = `€${total.toFixed(2)}`;
    });
}

// Call it when page loads
updateMenuCartInfo();

// Add to item click handlers
// Remove any existing click listeners first
document.querySelectorAll(".item-card").forEach((card) => {
  card.replaceWith(card.cloneNode(true));
});

// Add fresh click listeners
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
      .then(() => {
        updateMenuCartInfo();
      });
  });
});
