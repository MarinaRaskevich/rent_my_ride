<?php

$sectionName = 'Véhicules';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id = filter_input(INPUT_POST, 'id_vehicle', FILTER_SANITIZE_NUMBER_INT);

        /////////// deleted_at ///////////
        $local_timezone = new DateTimeZone("Europe/Paris");
        $deleteTime = new DateTime();
        $deleteTime->setTimezone($local_timezone);
        $deleted_at = $deleteTime->format('Y-m-d H:i:s');

        $vehicle = new Vehicle();
        $isOk = $vehicle->delete($id, $deleted_at);

        if ($isOk != false) {
            redirectToRoute('?page=vehicles/list');
        }
    } catch (\PDOException $e) {
        $error = $e->getMessage();
        renderView('404');
    }
}
