const categorySelect = document.querySelector("#category");
const form = document.querySelector("form");

const formAction = () => {
  form.submit();
};

categorySelect.addEventListener("change", formAction);
