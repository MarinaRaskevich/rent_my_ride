<?php
require_once __DIR__ . '/../models/Vehicle.php';

try {
    $query = isset($_POST['query']) ? $_POST['query'] : '';
    $vehicleModel = new Vehicle();
    $vehiclesList = $vehicleModel->getMatchForSearch($query);

    // Envoyer les résultats en JSON
    header('Content-Type: application/json');
    echo json_encode($vehiclesList);
} catch (\Throwable $th) {
    //throw $th;
}
