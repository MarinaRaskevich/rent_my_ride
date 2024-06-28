// Selectors
const filters = document.querySelector("#filtersSideBar");
//const bsOffcanvas = new bootstrap.Offcanvas(filters);
const mqLarge = window.matchMedia("(min-width: 1024px)");

//Show offcanvas in large screen
const changeFiltersVisibility = (event) => {
  if (event.matches) {
    filters.classList.remove("offcanvas");
    filters.classList.add("offcanvas.show");
  } else {
    filters.classList.remove("offcanvas.show");
    filters.classList.add("offcanvas");
  }
};

changeFiltersVisibility(mqLarge);

mqLarge.addEventListener("change", changeFiltersVisibility);
