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
document.querySelectorAll(".amount-clear").forEach((button) => {
  button.addEventListener("click", function () {
    const productId = this.dataset.productId;
    const itemElement = this.closest(".item");
    const quantityElement = itemElement.querySelector(".amount-text");

    fetch("delete_product.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "product_id=" + productId,
    })
      .then((response) => response.text())
      .then((newQuantity) => {
        if (newQuantity > 0) {
          quantityElement.textContent = newQuantity;
        } else {
          itemElement.remove();
          checkAndUpdateEmptyState(); // Moved here after item removal
        }

        let total = 0;
        document.querySelectorAll(".name-price p").forEach((price) => {
          total += parseFloat(price.textContent.replace("€", ""));
        });
        document.getElementById("total-price").textContent = "€" + total.toFixed(2);
        updateCartCount();
      });
  });
});

document.querySelectorAll(".amount-plus").forEach((button) => {
  button.addEventListener("click", function () {
    const productId = this.closest(".item").querySelector(".amount-clear").dataset.productId;
    const priceElement = this.closest(".item").querySelector(".name-price p");
    const basePrice = parseFloat(this.closest(".item").dataset.basePrice); // Add data-base-price attribute to your HTML

    fetch("update_quantity.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "product_id=" + productId + "&action=increase",
    })
      .then((response) => response.text())
      .then((newQuantity) => {
        // Update quantity
        this.closest(".amount-box").querySelector(".amount-text").textContent = newQuantity;
        // Update item price using base price
        const newPrice = (basePrice * newQuantity).toFixed(2);
        priceElement.textContent = "€" + newPrice;

        // Recalculate total
        let total = 0;
        document.querySelectorAll(".name-price p").forEach((price) => {
          total += parseFloat(price.textContent.replace("€", ""));
        });
        document.getElementById("total-price").textContent = "€" + total.toFixed(2);
        updateCartCount();
      });
  });
});

document.querySelectorAll(".amount-minus").forEach((button) => {
  button.addEventListener("click", function () {
    const productId = this.closest(".item").querySelector(".amount-clear").dataset.productId;
    const priceElement = this.closest(".item").querySelector(".name-price p");
    const basePrice = parseFloat(this.closest(".item").dataset.basePrice);
    const itemElement = this.closest(".item");

    fetch("update_quantity.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "product_id=" + productId + "&action=decrease",
    })
      .then((response) => response.text())
      .then((newQuantity) => {
        if (newQuantity > 0) {
          // Update quantity
          this.closest(".amount-box").querySelector(".amount-text").textContent = newQuantity;
          // Update item price using base price
          const newPrice = (basePrice * newQuantity).toFixed(2);
          priceElement.textContent = "€" + newPrice;

          // Recalculate total
          let total = 0;
          document.querySelectorAll(".name-price p").forEach((price) => {
            total += parseFloat(price.textContent.replace("€", ""));
          });
          document.getElementById("total-price").textContent = "€" + total.toFixed(2);
        } else {
          itemElement.remove();
          checkAndUpdateEmptyState(); // Add this line
        }
        updateCartCount();
      });
  });
});

function updateCartCount() {
  let totalItems = 0;
  document.querySelectorAll(".amount-text").forEach((quantity) => {
    totalItems += parseInt(quantity.textContent);
  });
  // Update both cart count elements
  document.querySelector("#cart p").textContent = totalItems;
  document.querySelector("#cart-amount").textContent = totalItems;
}
document.querySelector("#bestel").addEventListener("click", function (e) {
  e.preventDefault(); // Add this line to prevent default link behavior
  console.log("Bestel clicked");
  fetch("update_order_status.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Response:", data);
      window.location.href = `paid.php?pickup=${data.pickup_number}`;
    })
    .catch((error) => {
      console.log("Error:", error);
    });
});
// Show/hide empty cart message
function checkEmptyCart() {
  const items = document.querySelectorAll(".item");
  const emptyMessage = document.getElementById("empty-cart-message");
  if (items.length === 0) {
    emptyMessage.style.display = "block";
  } else {
    emptyMessage.style.display = "none";
  }
}

// Call on page load
document.addEventListener("DOMContentLoaded", checkEmptyCart);

document.querySelector("#bestel2").addEventListener("click", function (e) {
  const items = document.querySelectorAll(".item");
  if (items.length === 0) {
    e.preventDefault();
    const message = document.querySelector("#empty-cart-message");
    if (message) {
      message.classList.add("message-animate");
      setTimeout(() => {
        message.classList.remove("message-animate");
      }, 3000);
    }
  }
});

function checkAndUpdateEmptyState() {
  const items = document.querySelectorAll(".item");
  if (items.length === 0) {
    document.getElementById("bestel2").style.pointerEvents = "none";
    document.getElementById("bestel2").style.opacity = "0.5";
    document.getElementById("bestel2").href = "#";

    // Show empty cart message
    const emptyMessage = document.createElement("div");
    emptyMessage.id = "empty-cart-message";
    emptyMessage.style.color = "red";
    emptyMessage.style.textAlign = "center";
    emptyMessage.textContent = "You don't have anything in your cart";
    document.getElementById("content").prepend(emptyMessage);
  }
}
