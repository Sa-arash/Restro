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

