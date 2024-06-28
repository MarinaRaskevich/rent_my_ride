<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row h-100">
        <div class="col-2 bg-white">
            <?php include __DIR__ . '/../templates/navbar.php'; ?>
        </div>
        <div class="col-10" id="content">
            <div class="row d-flex justify-content-center my-5">
                <div class="col-8">
                    <p class="text-center fw-bold fs-4">Modifier les informations sur la voiture</p>
                    <form method="post" enctype="multipart/form-data" class="vehicle_form">
                        <div class="mb-3">
                            <label for="brand" class="form-label fw-bold">Marque</label>
                            <input class="form-control" type="text" id="brand" name="brand" maxlength="50" value="<?= $oneVehicle->brand ?>" required>
                            <small class="error"><?= $errors['brand'] ?? '' ?></small>
                        </div>
                        <div class="mb-3">
                            <label for="model" class="form-label fw-bold">Modèle</label>
                            <input class="form-control" type="text" id="model" name="model" maxlength="50" value="<?= $oneVehicle->model ?>" required>
                            <small class="error"><?= $errors['model'] ?? '' ?></small>
                        </div>

                        <div class="mb-3">
                            <label for="registration" class="form-label fw-bold">Numéro d'immatriculation</label>
                            <input class="form-control" type="text" id="registration" name="registration" maxlength="10" pattern="<?= REGEX_REGISTRATION ?>" value="<?= $oneVehicle->registration ?>" required>
                            <small class="error"><?= $errors['registration'] ?? '' ?></small>
                        </div>

                        <div class="mb-3">
                            <label for="mileage" class="form-label fw-bold">Kilométrage</label>
                            <input class="form-control" type="text" id="mileage" name="mileage" pattern="<?= REGEX_MILEAGE ?>" value="<?= $oneVehicle->mileage ?>" required>
                            <small class="error"><?= $errors['mileage'] ?? '' ?></small>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label fw-bold">Prix par jour</label>
                            <input class="form-control" type="text" id="price" name="price" placeholder="ex. 35" value="<?= $oneVehicle->price  ?? '' ?>" required>
                            <span class="small text-danger"><?= $errors['price'][0] ?? '' ?></span>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label fw-bold">Sélectionnez la catégorie de voiture</label>
                            <select class="form-select" name="category" id="category" required>
                                <option disabled>---Sélectionnez la catégorie---</option>
                                <?php foreach ($categoryList as $category) {
                                    $isSelected = ($oneVehicle->id_category == $category['id_category']) ? 'selected' : ''; ?>
                                    <option <?= $isSelected ?> value="<?= $category['id_category'] ?>"><?= $category['name'] ?></option>
                                <?php } ?>
                            </select>
                            <small class="category"><?= $errors['brand'] ?? '' ?></small>
                        </div>

                        <div class="mb-3">
                            <label for="picture" class="form-label fw-bold">Photo</label>
                            <input class="form-control" type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg">
                            <small class="error"><?= $errors['picture'] ?? '' ?></small>

                            <div class="position-relative overflow-hidden mt-3">
                                <div class="rounded-2 bg-white w-50">
                                    <img src="/public/uploads/<?= $oneVehicle->picture !== 'default.png' ? $oneVehicle->picture : '' ?>" alt="image" class="w-100 <?= $oneVehicle->picture == 'default.png' ? 'd-none' : '' ?>" id="vehicleImage">
                                    <span title="Supprimer" class="position-absolute deleteImage"><i class="bi bi-x fs-2"></i></span>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary fs-5">Modifier</button>
                        </div>
                        <div>
                            <input type="hidden" id="existingPicture" name="existingPicture" value="<?= $oneVehicle->picture ?>">
                            <input type="hidden" id="isDeleted" name="isDeleted" value="0">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>