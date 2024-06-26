const deleteImage = document.querySelector(".deleteImage");
const existingPicture = document.querySelector("#existingPicture");
const vehicleImage = document.querySelector("#vehicleImage");
const picture = document.querySelector("#picture");

const deleteElement = () => {
  vehicleImage.classList.add("d-none");
  existingPicture.value = "deleted";
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

  existingPicture.value = "deleted";
};

deleteImage.addEventListener("click", deleteElement);
picture.addEventListener("change", getPicture);
