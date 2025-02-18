function updateRandomNumber() {
  fetch("get_new_random.php")
    .then((response) => response.text())
    .then((data) => {
      const [imagePath, name, price, kcal] = data.split("||");
      const img = document.querySelector(".ad-product-image");
      const nameEl = document.querySelector(".product-name");
      const priceEl = document.querySelector(".product-price");
      const kcalEl = document.querySelector(".product-kcal");

      img.classList.add("fade-out");
      setTimeout(() => {
        img.src = imagePath;
        nameEl.textContent = name;
        priceEl.textContent = "€" + price;
        kcalEl.textContent = kcal + " kcal";
        img.classList.remove("fade-out");
      }, 800);
    });
}

// Pak de tijd van nu
let now = new Date();
// Nieuwe update in 8 sec
let nextUpdate = new Date(Math.ceil(now.getTime() / 10000) * 10000);

function checkTime() {
  now = new Date();
  if (now >= nextUpdate) {
    updateRandomNumber();
    nextUpdate = new Date(Math.ceil(now.getTime() / 10000) * 10000);
  }
  requestAnimationFrame(checkTime);
}

checkTime();
