let debounceTimerForCity;
const debounceForCity = (func, delay) => {
  clearTimeout(debounceTimer);
  debounceTimerForCity = setTimeout(func, delay);
};

const getCity = () => {
  if (zipcode.value.length == 0) {
    city.value = "";
  }

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
    }, 200);
  }
};

document.addEventListener("DOMContentLoaded", function () {
  const startDateInput = document.getElementById("startdate");
  const endDateInput = document.getElementById("enddate");

  const startPicker = flatpickr(startDateInput, {
    dateFormat: "d-m-Y",
    locale: "fr",
    minDate: "today",
    onChange: function (selectedDates, dateStr, instance) {
      if (selectedDates.length > 0) {
        endPicker.set("minDate", selectedDates[0]);
      }
    },
  });

  const endPicker = flatpickr(endDateInput, {
    dateFormat: "d-m-Y",
    locale: "fr",
    minDate: "today",
    onChange: function (selectedDates, dateStr, instance) {
      if (selectedDates.length > 0) {
        startPicker.set("maxDate", selectedDates[0]);
      }
    },
  });
});

zipcode.addEventListener("change", getCity);
