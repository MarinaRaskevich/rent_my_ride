const deleteImage = document.querySelector(".deleteImage");
const isDeleted = document.querySelector("#isDeleted");
const vehicleImage = document.querySelector("#vehicleImage");
const picture = document.querySelector("#picture");

const deleteElement = () => {
  vehicleImage.classList.add("d-none");
  isDeleted.value = "1";
  picture.value = "";
};

const getPicture = (event) => {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      vehicleImage.src = e.target.result;
      vehicleImage.classList.remove("d-none");
    };
    reader.readAsDataURL(file);
  }

  isDeleted.value = "1";
};

deleteImage.addEventListener("click", deleteElement);
picture.addEventListener("change", getPicture);
