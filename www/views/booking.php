<?php ob_start(); ?>
<div class="container my-5">
    <h1 class="text-center fs-2">Réservation de: <?= $vehicle->brand . ' ' . $vehicle->model ?></h1>
    </h1>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6">
            <form method="post">
                <div class="mb-3">
                    <label for="lastname" class="form-label mb-1">Nom <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="ex: Dupont" autocomplete="family-name" maxlength="50" pattern="<?= REGEX_NAME ?>" value="<?= $lastname ?? '' ?>" required>
                    <span class="small text-danger"><?= $errors['lastname'][0] ?? '' ?></span>
                </div>
                <div class="mb-3">
                    <label for="firstname" class="form-label mb-1">Prénom <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ex: Pierre" autocomplete="given-name" maxlength="50" pattern="<?= REGEX_NAME ?>" value="<?= $firstname ?? '' ?>" required>
                    <span class="small text-danger"><?= $errors['firstname'][0] ?? '' ?></span>
                </div>

                <div class="mb-3">
                    <label for="birthdate" class="form-label mb-1">Date de naissance <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" pattern="<?= REGEX_DATE ?>" value="<?= $birthdate ?? '' ?>" required>
                    <span class="small text-danger"><?= $errors['birthdate'][0][0] ?? '' ?></span>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label mb-1">Votre email <span class="text-danger">*</span></label>
                    <input class="form-control" type="email" id="email" name="email" placeholder="ex: example@gmail.com" autocomplete="email" maxlength="255" value="<?= $email ?? '' ?>" required>
                    <span class="small text-danger"><?= $errors['email'][0] ?? '' ?></span>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label mb-1">Numéro de téléphone <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="phone" name="phone" pattern="<?= REGEX_PHONE ?>" value="<?= $phone ?? '' ?>" placeholder="ex: 06xxxxxxxx" required>
                    <span class="small text-danger"><?= $errors['phone'][0] ?? '' ?></span>
                </div>
                <div class="mb-3">
                    <label for="zipcode" class="form-label mb-1">Code postal <span class="text-danger">*</span></label>
                    <input class="form-control" maxlength="5" type="text" id="zipcode" name="zipcode" autocomplete="postal-code" value="<?= $zipcode ?? '' ?>" pattern="<?= REGEX_ZIPCODE ?>" placeholder="ex: 06000" required>
                    <span class="small text-danger"><?= $errors['zipcode'][0] ?? '' ?></span>
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label mb-1">Ville <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="city" id="city" value="<?= $city ?? '' ?>" maxlength="100" placeholder="ex: Nice" required>
                    <span class="small text-danger"><?= $errors['city'][0] ?? '' ?></span>
                </div>

                <div class="mb-3">
                    <label for="startdate" class="form-label mb-1">Date de début <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" id="startdate" name="startdate" value="<?= $startdate ?? '' ?>" pattern="<?= REGEX_DATE ?>" required>
                    <span class="small text-danger"><?= $errors['startdate'][0] ?? '' ?></span>
                </div>

                <div class="mb-3">
                    <label for="enddate" class="form-label mb-1">Date de fin <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" id="enddate" name="enddate" value="<?= $enddate ?? '' ?>" pattern="<?= REGEX_DATE ?>" required>
                    <span class="small text-danger"><?= $errors['enddate'][0] ?? '' ?></span>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" type="submit">Réserver</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>