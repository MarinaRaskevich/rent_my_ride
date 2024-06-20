<?php ob_start(); ?>
<div class="row d-flex justify-content-center mt-5">
    <div class="col-8">
        <p class="text-center fw-bold fs-4 mt-2">Remplissez les informations sur le véhicule</p>
        <form method="POST" enctype="multipart/form-data" class="vehicle_form">
            <div class="mb-3">
                <label for="brand" class="form-label fw-bold">Marque <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="brand" name="brand" maxlength="50" placeholder="ex. Renault" value="<?= $brand ?? '' ?>" required>
                <div class="error small text-danger"><?php if (isset($errors['brand'])) {
                                                            foreach ($errors['brand'] as $error) {
                                                                echo $error;
                                                            }
                                                        } ?></div>
            </div>

            <div class="mb-3">
                <label for="model" class="form-label fw-bold">Modèle <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="model" name="model" maxlength="50" placeholder="ex. Twingo" value="<?= $model ?? '' ?>" required>
                <div class="error small text-danger"><?php if (isset($errors['model'])) {
                                                            foreach ($errors['model'] as $error) {
                                                                echo $error;
                                                            }
                                                        } ?></div>
            </div>

            <div class="mb-3">
                <label for="registration" class="form-label fw-bold">Numéro d'immatriculation <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="registration" name="registration" maxlength="10" pattern="<?= REGEX_REGISTRATION ?>" placeholder="ex. AA-000-AA" value="<?= $registration ?? '' ?>" required>
                <div class="error small text-danger"><?php if (isset($errors['registration'])) {
                                                            foreach ($errors['registration'] as $error) {
                                                                echo $error;
                                                            }
                                                        } ?></div>
            </div>

            <div class="mb-3">
                <label for="mileage" class="form-label fw-bold">Kilométrage <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="mileage" name="mileage" pattern="<?= REGEX_MILEAGE ?>" placeholder="ex. 10000" value="<?= $mileage ?? '' ?>" required>
                <div class="error small text-danger"><?php if (isset($errors['mileage'])) {
                                                            foreach ($errors['mileage'] as $error) {
                                                                echo $error;
                                                            }
                                                        } ?></div>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label fw-bold">Sélectionnez la catégorie de voiture <span class="text-danger">*</span></label>
                <select class="form-select" name="category" id="category" required>
                    <option disabled>---Sélectionnez la catégorie---</option>
                    <?php foreach ($categoryList as $category) {
                        $isSelected = ($categoryId == $category['id_category']) ? 'selected' : ''; ?>
                        <option <?= $isSelected ?> value="<?= $category['id_category'] ?>"><?= $category['name'] ?></option>
                    <?php } ?>
                </select>
                <div class="error small text-danger"><?php if (isset($errors['categoryId'])) {
                                                            foreach ($errors['categoryId'] as $error) {
                                                                echo $error;
                                                            }
                                                        } ?></div>
            </div>

            <div class="mb-3">
                <label for="picture" class="form-label fw-bold">Photo</label>
                <input class="form-control" type="file" id="picture" name="picture" accept="image/png, image/jpeg, image/jpg">
                <small class="error"><?= $errors['picture'] ?? '' ?></small>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Ajouter</button>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); ?>