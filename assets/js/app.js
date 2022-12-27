const body = document.querySelector("body");
const burgerMenu = document.querySelector(".burger-menu");
const burgerClose = document.querySelector(".burger-close");

burgerMenu.addEventListener("click", () => {
  body.classList.add("visible");
});

burgerClose.addEventListener("click", () => {
  body.classList.remove("visible");
});

window.addEventListener("resize", () => {
  const width = window.innerWidth;
  if (width >= 992) {
    body.classList.remove("visible");
  }
});
