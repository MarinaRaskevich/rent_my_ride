const forms = document.querySelectorAll(".modal-form");

forms.forEach(function (form) {
  form.addEventListener("submit", function (e) {
    e.preventDefault();
    let currentForm = e.target;
    let elementName = e.target.dataset.name;
    let modal = new bootstrap.Modal(document.getElementById("delete-modal"));
    const modalBody = document.querySelector(".modal-body");

    if (elementName == "rent") {
      modalBody.innerText = `Êtes-vous sûr de vouloir confirmer cette réservation et envoyer au client un message de confirmation?`;
    } else {
      modalBody.innerText = `Êtes-vous sûr de vouloir supprimer "${elementName}"?`;
    }
    modal.show();

    document
      .querySelector('[data-valid="true"]')
      .addEventListener("click", () => currentForm.submit());
  });
});
