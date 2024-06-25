<?php
$title = "Rent My Ride";

try {
    if (!isset($_GET['id'])) {
        throw new Exception("Une erreur est survenue");
    };

    $id = $_GET['id'];
    $vehicleModel = new Vehicle();
    $vehicle = $vehicleModel->getOne($id);
} catch (\Throwable $th) {
    //throw $th;
}

renderView('vehicle-detail', compact('title', 'vehicle'));
