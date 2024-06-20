<?php
require_once __DIR__ . '/../../models/Vehicle.php';

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

require_once __DIR__ . '/../../views/clients/vehicle-detail.php';
require_once __DIR__ . '/../../views/clients/templates/template.php';
