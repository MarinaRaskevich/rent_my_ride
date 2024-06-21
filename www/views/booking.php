<?php ob_start(); ?>
<div class="container my-3">
    <h1 class="text-center fw-bold fs-2">Réservation</h1>
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-6">
            <form method="post">
                <p class="fw-bold mt-3">Informations Personnelles du Conducteur</p>
                <div class="mb-3">
                    <label for="lastname" class="form-label small mb-1">Nom <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="ex: Dupont" required>
                </div>
                <div class="mb-3">
                    <label for="firstname" class="form-label small mb-1">Prénom <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ex: Jean" required>
                </div>

                <div class="mb-3">
                    <label for="birthdate" class="form-label small mb-1">Date de naissance <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>