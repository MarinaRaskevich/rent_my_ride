let debounceTimerForCity;
const debounceForCity = (func, delay) => {
  clearTimeout(debounceTimer);
  debounceTimerForCity = setTimeout(func, delay);
};

const getCity = () => {
  if (zipcode.value.length == 5) {
    let newForm = new FormData();
    newForm.append("zipcode", zipcode.value);

    let options = {
      method: "POST",
      body: newForm,
    };

    debounceForCity(() => {
      fetch("/controllers/zipCodeAjax-ctrl.php", options)
        .then((response) => {
          return response.json();
        })
        .then((result) => {
          city.value = "";
          city.value = result[0].nomCommune;
        });
    }, 300);
  }
};

zipcode.addEventListener("change", getCity);
