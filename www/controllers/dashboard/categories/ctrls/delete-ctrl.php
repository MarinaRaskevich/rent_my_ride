<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        $id = filter_input(INPUT_POST, 'id_category', FILTER_SANITIZE_NUMBER_INT);
        $categoryModel = new Category();
        $isOk = $categoryModel->delete($id);
        if ($isOk != false) {
            addFlash('success', 'Suppression effectué avec succès !');
            redirectToRoute('?page=categories/list');
        } else {
            renderView('404');
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        $vehicleModel = new Vehicle();
        $vehicles = $vehicleModel->getAll($id);
        if ($vehicles) {
            addFlash('danger', 'Erreur: vous ne pouvez pas supprimer la catégorie \'' . $categoryModel->getOne($id)->name . '\' (il y a ' . count($vehicles) . ' voiture(s) dans cette catégorie)');
            redirectToRoute('?page=categories/list');
        }
    }
}
