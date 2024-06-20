<?php
require_once __DIR__ . '/../../../models/Vehicle.php';

$title = 'Véhicules';

try {
    $column = filter_input(INPUT_GET, 'column', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!$column) {
        $column = 'name';
    }
    $order = filter_input(INPUT_GET, 'order', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!$order) {
        $order = 'ASC';
    }
    $vehicle = new Vehicle();
    $vehiclesList = $vehicle->getAllForDashboard($column, $order);
} catch (\PDOException $e) {
    $errors = $e->getMessage();
    include __DIR__ . '/../../../views/error.php';
}

require_once __DIR__ . '/../../../views/dashboard/vehicles/list.php';
require_once __DIR__ . '/../../../views/dashboard/templates/template.php';
