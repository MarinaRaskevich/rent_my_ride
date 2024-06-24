<?php ob_start(); ?>
<div class="container my-5">
    <h1 class="text-center fs-2">Réservation de: <?= $vehicle->brand . ' ' . $vehicle->model ?></h1>
    </h1>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6">
            <form method="post">
                <div class="mb-3">
                    <label for="lastname" class="form-label mb-1">Nom <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="ex: Dupont" required>
                </div>
                <div class="mb-3">
                    <label for="firstname" class="form-label mb-1">Prénom <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ex: Pierre" required>
                </div>

                <div class="mb-3">
                    <label for="birthdate" class="form-label mb-1">Date de naissance <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label mb-1">Votre email <span class="text-danger">*</span></label>
                    <input class="form-control" type="email" id="email" name="email" required placeholder="ex: example@gmail.com">
                    <?= $errors['email'] ?? '' ?>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label mb-1">Numéro de téléphone <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="phone" name="phone" required placeholder="ex: 06xxxxxxxx">
                </div>
                <div class="mb-3">
                    <label for="zipcode" class="form-label mb-1">Code postal <span class="text-danger">*</span></label>
                    <input class="form-control" maxlength="5" type="text" id="zipcode" name="zipcode" required placeholder="ex: 06000">
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label mb-1">Ville <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="city" id="city" required placeholder="ex: Nice">
                </div>

                <div class="mb-3">
                    <label for="startdate" class="form-label mb-1">Date de début <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" id="startdate" name="startdate" required>
                </div>

                <div class="mb-3">
                    <label for="enddate" class="form-label mb-1">Date de fin <span class="text-danger">*</span></label>
                    <input class="form-control" type="date" id="enddate" name="enddate" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary" type="submit">Réserver</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>