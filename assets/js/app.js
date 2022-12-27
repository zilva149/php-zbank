const body = document.querySelector("body");
const burgerMenu = document.querySelector(".burger-menu");
const burgerClose = document.querySelector(".burger-close");
const modal = document.querySelector(".modal");
const modal_sm = document.querySelector(".modal-sm");

if (burgerMenu) {
  burgerMenu.addEventListener("click", () => {
    body.classList.add("visible");
  });
}

if (burgerClose) {
  burgerClose.addEventListener("click", () => {
    body.classList.remove("visible");
  });
}

window.addEventListener("resize", () => {
  const width = window.innerWidth;
  if (width >= 992) {
    body.classList.remove("visible");
  }
});

if (modal) {
  setTimeout(() => {
    modal.remove();
  }, 3000);
}

if (modal_sm) {
  setTimeout(() => {
    modal_sm.remove();
  }, 3000);
}
