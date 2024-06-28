<?php ob_start(); ?>
<div class="container h-100 py-4">
    <div class="row h-100">
        <div class="col-7 d-flex align-items-center">
            <img src="/public/uploads/<?= $vehicle->picture ?>" alt="" class="w-100 vehicle-img ">
        </div>
        <div class="col-5 d-flex flex-column justify-content-center align-items-center">
            <h1 class="fs-2 fw-bold mb-3"><?= $vehicle->brand . ' ' . $vehicle->model ?></h1>
            <p>Catégorie: <?= $vehicle->name ?></p>
            <p>Numéro d'immatriculation: <?= $vehicle->registration ?></p>
            <p>Kilométrage: <?= $vehicle->mileage ?></p>
            <p>Prix: <?= $vehicle->price ?>€ / par jour</p>
            <a href="?page=booking&id=<?= $vehicle->id_vehicle ?>" class="btn btn-primary">Réserver</a>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>