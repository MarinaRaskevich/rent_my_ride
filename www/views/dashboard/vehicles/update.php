<?php ob_start(); ?>
<div class="row d-flex justify-content-center mt-5">
    <div class="col-8">
        <p class="text-center fw-bold fs-4">Modifier les informations sur la voiture</p>
        <form method="post" enctype="multipart/form-data" class="vehicle_form">
            <div>
                <label for="brand" class="form-label fw-bold">Marque</label>
                <input class="form-control" type="text" id="brand" name="brand" maxlength="50" value="<?= $oneVehicle->brand ?>" required>
                <small class="error"><?= $errors['brand'] ?? '' ?></small>
            </div>
            <div>
                <label for="model" class="form-label fw-bold">Modèle</label>
                <input class="form-control" type="text" id="model" name="model" maxlength="50" value="<?= $oneVehicle->model ?>" required>
                <small class="error"><?= $errors['model'] ?? '' ?></small>
            </div>

            <div>
                <label for="registration" class="form-label fw-bold">Numéro d'immatriculation</label>
                <input class="form-control" type="text" id="registration" name="registration" maxlength="10" pattern="<?= REGEX_REGISTRATION ?>" value="<?= $oneVehicle->registration ?>" required>
                <small class="error"><?= $errors['registration'] ?? '' ?></small>
            </div>

            <div>
                <label for="mileage" class="form-label fw-bold">Kilométrage</label>
                <input class="form-control" type="text" id="mileage" name="mileage" pattern="<?= REGEX_MILEAGE ?>" value="<?= $oneVehicle->mileage ?>" required>
                <small class="error"><?= $errors['mileage'] ?? '' ?></small>
            </div>

            <div>
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

            <div>
                <label for="picture" class="form-label fw-bold">Photo</label>
                <input class="form-control" type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg">
                <small class="error"><?= $errors['picture'] ?? '' ?></small>
                <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
            </div>
            <div>
                <input type="hidden" name="existingPicture" value="<?= $oneVehicle->picture ?>">
            </div>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); ?>