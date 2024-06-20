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
  // searchText = removeAccent(searchText); // Supprimer les accents de la valeur saisie

  debounce(() => {
    if (searchText.trim() === "") {
      // Si le champ de recherche est vide, effacer les résultats de la recherche
      searchResults.innerHTML = "";
    } else {
      // Utiliser fetch pour envoyer une requête au serveur
      fetch("/controllers/search-ctrl.php", {
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
              return `<div><a class="search_bar_result text-decoration-none" href="controllers/pokemonDetailController.php?id=${result.id}">${result.brand} ${result.model}</a></div>`;
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

//fonction pour supprimer les accents des lettres
// const removeAccent = (str) => {
//   const normalizedStr = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
//   return normalizedStr;
// };

searchInput.addEventListener("input", getResults);

window.addEventListener("mouseup", function (event) {
  if (!event.target.closest("#searchResults")) {
    searchResults.innerHTML = "";
    searchInput.value = "";
  }
});
