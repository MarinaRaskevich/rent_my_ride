<?php

try {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $categoryModel = new Category();
    $isOk = $categoryModel->delete($id);
    if ($isOk != false) {
        redirectToRoute('?page=categories/list');
    } else {
        $vehicleModel = new Vehicle();
        $vehicles = $vehicleModel->getAll($id);
        var_dump($vehicles);
        if ($vehicles) {
            addFlash('danger', "Vous ne pouvez pas supprimer cette catégorie car trois voitures y appartiennent");
            // redirectToRoute('?page=categories/list');
        }
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    // renderView('404');
} catch (\PDOException $e) {
    $error = $e->getMessage();
    // renderView('404');
}
