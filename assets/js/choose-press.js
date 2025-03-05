document.querySelector(".dine-in-image").addEventListener("click", function () {
  window.location.href = "create_order.php?type=dine_in";
});

document.querySelector(".take-out-image").addEventListener("click", function () {
  window.location.href = "create_order.php?type=take_out";
});
