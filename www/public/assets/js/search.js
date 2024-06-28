const searchInput = document.querySelector("#search");
const searchResults = document.querySelector("#searchResults");

let debounceTimer;
const debounce = (func, delay) => {
  clearTimeout(debounceTimer);
  debounceTimer = setTimeout(func, delay);
};

// Fonction principale pour récupérer et afficher les résultats de la recherche
const getResults = (e) => {
  let searchText = e.target.value; // Récupérer la valeur saisie par l'utilisateur

  debounce(() => {
    if (searchText.trim() === "") {
      // Si le champ de recherche est vide, effacer les résultats de la recherche
      searchResults.innerHTML = "";
    } else {
      // Utiliser fetch pour envoyer une requête au serveur
      fetch("?page=search", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          query: searchText,
        }),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.json();
        })
        .then((results) => {
          // Générer le HTML des résultats
          let resultsHTML = results
            .map((result) => {
              return `<div><a class="search_bar_result text-decoration-none" href="?page=vehicle/detail&id=${result.id_vehicle}">${result.brand} ${result.model}</a></div>`;
            })
            .join("");
          searchResults.innerHTML = resultsHTML;
        })
        .catch((error) => {
          console.error(error);
        });
    }
  }, 300); // 300ms delay
};

searchInput.addEventListener("input", getResults);

window.addEventListener("mouseup", function (event) {
  if (!event.target.closest("#searchResults")) {
    searchResults.innerHTML = "";
    searchInput.value = "";
  }
});
