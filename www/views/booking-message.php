<?php ob_start(); ?>
<div class="row d-flex justify-content-center mt-5">
    <div class="col-8 d-flex flex-column align-items-center justify-content-center">
        <span class="fw-bold fs-4 mb-4">Votre réservation a été effectuée avec succès !</span>
        <p class="text-center">Merci d'avoir choisi notre service de location de véhicules. Nous sommes ravis de confirmer que votre réservation a bien été enregistrée.</p>
        <p class="text-center"> Vous allez recevoir un email de confirmation contenant tous les détails de votre réservation dans les prochaines minutes. Veuillez vérifier votre boîte de réception ainsi que votre dossier de courriers indésirables/spams pour vous assurer de bien recevoir cet email.</p>
        <p class="text-center"> Nous vous souhaitons un excellent voyage avec votre véhicule réservé !</p>
        <p class="mt-3 mb-1 fw-bold"><?= $vehicle->brand . ' ' . $vehicle->model ?>
        </p>
        <div class="d-flex justify-content-center">
            <img src="/public/uploads/<?= $vehicle->picture ?>" alt="<?= $vehicle->brand ?>" class="w-50">
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>