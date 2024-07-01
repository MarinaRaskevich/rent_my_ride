<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id = filter_input(INPUT_POST, 'id_vehicle', FILTER_SANITIZE_NUMBER_INT);
        if (!$id) {
            throw new Exception('Une erreur est survenue');
        };

        $vehicle = new Vehicle();
        $isOk = $vehicle->delete($id);

        if ($isOk != false) {
            redirectToRoute('?page=vehicles/list');
        }
    } catch (\PDOException $e) {
        $error = $e->getMessage();
        renderView('404');
    }
}
