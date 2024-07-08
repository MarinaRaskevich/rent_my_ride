const categorySelect = document.querySelector("#category");
const form = document.querySelector("form");
const cardsContainer = document.querySelector("#vehicles-cards");

const formAction = () => {
  form.submit();
};

categorySelect.addEventListener("change", formAction);
