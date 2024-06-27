<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row h-100">
        <div class="col-2 bg-white">
            <?php include __DIR__ . '/templates/navbar.php'; ?>
        </div>
        <div class="col-10 p-3" id="content">
            <h1 class="fs-4 fw-bold text-center">Bonjour!</h1>
            <div class="row h-100">
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <div>
                        <p class="mb-1 text-center fs-1 fw-bold"><?= $nbCategories ?></p>
                        <p class="mb-0 text-center fs-5">catégories</p>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <div>
                        <p class="mb-1 text-center fs-1 fw-bold"><?= $nbVehicles ?></p>
                        <p class="mb-0 text-center fs-5">véhicules</p>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <div>
                        <p class="mb-1 text-center fs-1 fw-bold"><?= $nbRents ?></p>
                        <p class="mb-0 text-center fs-5">réservations en cours</p>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <div>
                        <p class="mb-1 text-center fs-1 fw-bold"><?= $nbClients ?></p>
                        <p class="mb-0 text-center fs-5">clients</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>