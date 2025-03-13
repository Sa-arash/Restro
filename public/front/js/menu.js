document.querySelectorAll(".menu-item").forEach((item) => {
  item.addEventListener("click", (event) => {
    document.querySelectorAll(".product").forEach((product) => {
      product.style.display = "none";
    });
    document.querySelectorAll(".nav-link").forEach((link) => {
      link.classList.remove("active");
    });
    event.target.classList.add("active");
    document.getElementById(
      event.target.getAttribute("data-target")
    ).style.display = "flex";
  });
});

// document.getElementById("main-course").style.display = "flex";
document.addEventListener("DOMContentLoaded", function () {
  const productCards = document.querySelectorAll(".product-card");
  const modal = new bootstrap.Modal(document.getElementById("productModal"));

  productCards.forEach((card) => {
    card.addEventListener("click", function () {
      const productImage = card.querySelector(".product-image img").src;
      const productName = card.querySelector(".product-info h3").textContent;
      const productDescription = card.querySelector(".product-info p").textContent;
      const productDiscount = card.querySelector(".discount").textContent;
      const productOriginalPrice = card.querySelector(".original-price").textContent;
      const productPrice = card.querySelector(".price").textContent;
      const productStars = card.querySelector(".stars").innerHTML;

      document.getElementById("modalProductImage").src = productImage;
      document.getElementById("modalProductName").textContent = productName;
      document.getElementById("modalProductDescription").textContent = productDescription;
      document.getElementById("modalProductDiscount").textContent = productDiscount;
      document.getElementById("modalProductOriginalPrice").textContent = productOriginalPrice;
      document.getElementById("modalProductPrice").textContent = productPrice;
      document.getElementById("modalProductStars").innerHTML = productStars;

      modal.show();
    });
  });
});