<?php
require_once __DIR__ . '/../../../models/Vehicle.php';

$title = 'Véhicles';

try {
    $id = $_GET['id'];

    /////////// deleted_at ///////////
    $local_timezone = new DateTimeZone("Europe/Paris");
    $deleteTime = new DateTime();
    $deleteTime->setTimezone($local_timezone);
    $deleted_at = $deleteTime->format('Y-m-d H:i:s');

    $vehicle = new Vehicle();
    $isOk = $vehicle->delete($id, $deleted_at);

    if ($isOk != false) {
        header('Location:/controllers/dashboard/vehicles/list-ctrl.php');
        exit;
    }
} catch (\PDOException $e) {
    $errors = $e->getMessage();
    include __DIR__ . '/../../../views/error.php';
}
