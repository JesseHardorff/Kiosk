function updateRandomImage() {
  const img = document.querySelector(".ad-product-image");

  // Add fade out class
  img.classList.add("fade-out");

  // After fade out, fetch new image
  setTimeout(() => {
    fetch("get_random_image.php")
      .then((response) => response.text())
      .then((newImagePath) => {
        img.src = newImagePath;
        img.classList.remove("fade-out");
      });
  }, 500);
}

// Start the interval
setInterval(updateRandomImage, 5000);
