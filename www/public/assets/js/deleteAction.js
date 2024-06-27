const forms = document.querySelectorAll(".delete-form");

forms.forEach(function (form) {
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    let currentForm = e.target;
    let elementToDelete = e.target.dataset.name;
    let deleteModal = new bootstrap.Modal(
      document.getElementById("delete-modal")
    );
    const modalBody = document.querySelector(".modal-body");
    modalBody.innerText = `Êtes-vous sûr de vouloir supprimer "${elementToDelete}"?`;
    deleteModal.show();

    document
      .querySelector('[data-valid="true"]')
      .addEventListener("click", () => currentForm.submit());
  });
});
