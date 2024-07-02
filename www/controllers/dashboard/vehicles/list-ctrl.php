<?php

$title = 'Véhicules';
$sectionName = 'Véhicules';
$script = 'showModal';

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
    $vehiclesList = $vehicle->getAll(null, null, null, $column, $order);
} catch (\PDOException $e) {
    $error = $e->getMessage();
    renderView('404');
}

renderView('dashboard/vehicles/list', compact('title', 'vehiclesList', 'order', 'sectionName', 'script'));
