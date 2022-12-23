const header = document.querySelector(".header");
const burgerMenu = document.querySelector(".burger-menu");
const burgerClose = document.querySelector(".burger-close");

burgerMenu.addEventListener("click", () => {
  header.classList.add("visible");
});

burgerClose.addEventListener("click", () => {
  header.classList.remove("visible");
});
