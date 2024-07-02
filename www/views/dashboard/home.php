<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/templates/navbar.php'; ?>
        <div class="col-12 col-lg-10" id="content">
            <h1 class="fs-4 fw-bold text-center py-4">Bonjour!</h1>
            <div class="row">
                <div class="col-6 col-lg-4 d-flex justify-content-center align-items-center py-5">
                    <div>
                        <p class="mb-1 text-center fs-1 fw-bold"><?= $nbCategories ?></p>
                        <p class="mb-0 text-center fs-5">catégories</p>
                    </div>
                </div>
                <div class="col-6 col-lg-4 py-5 d-flex justify-content-center align-items-center bg-primary-subtle">
                    <div>
                        <p class="mb-1 text-center fs-1 fw-bold"><?= $nbVehicles ?></p>
                        <p class="mb-0 text-center fs-5">véhicules</p>
                    </div>
                </div>
                <div class="col-6 col-lg-4 py-5 d-flex justify-content-center align-items-center">
                    <div>
                        <p class="mb-1 text-center fs-1 fw-bold"><?= $nbClients ?></p>
                        <p class="mb-0 text-center fs-5">clients</p>
                    </div>
                </div>
                <div class="col-6 col-lg-4 py-5 d-flex justify-content-center align-items-center
                bg-danger-subtle">
                    <div>
                        <p class="mb-1 text-center fs-1 fw-bold"><?= $nbCurrentRents ?></p>
                        <p class="mb-0 text-center fs-5">réservations en cours</p>
                    </div>
                </div>
                <div class="col-6 col-lg-4 py-5 d-flex justify-content-center align-items-center">
                    <div>
                        <p class="mb-1 text-center fs-1 fw-bold"><?= $nbUpcomingRents ?></p>
                        <p class="mb-0 text-center fs-5">réservations à venir</p>
                    </div>
                </div>
                <div class="col-6 col-lg-4 py-5 d-flex justify-content-center align-items-center bg-success-subtle">
                    <div>
                        <p class="mb-1 text-center fs-1 fw-bold"><?= $nbNonConfirmedRents ?></p>
                        <p class="mb-0 text-center fs-5">réservations à confirmer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>