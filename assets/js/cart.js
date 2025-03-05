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
        }
      });
  });
});


document.querySelectorAll('.amount-plus').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.closest('.item').querySelector('.amount-clear').dataset.productId;
        
        fetch('update_quantity.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'product_id=' + productId + '&action=increase'
        })
        .then(response => response.text())
        .then(newQuantity => {
            this.closest('.amount-box').querySelector('.amount-text').textContent = newQuantity;
        });
    });
});

document.querySelectorAll('.amount-minus').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.closest('.item').querySelector('.amount-clear').dataset.productId;
        const itemElement = this.closest('.item');
        
        fetch('update_quantity.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'product_id=' + productId + '&action=decrease'
        })
        .then(response => response.text())
        .then(newQuantity => {
            if(newQuantity > 0) {
                this.closest('.amount-box').querySelector('.amount-text').textContent = newQuantity;
            } else {
                itemElement.remove();
            }
        });
    });
});
