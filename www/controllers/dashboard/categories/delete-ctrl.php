<?php
require_once __DIR__ . '/../../../models/Category.php';
require __DIR__ . '/../../../helpers/http_helper.php';

try {
    $id = $_GET['id'];
    $category = new Category();
    $isOk = $category->delete($id);
    if ($isOk != false) {
        //Поменять
        //header('Location:/');
        header('Location:/controllers/dashboard/categories/list-ctrl.php');
        redirectToRoute('');
        exit;
    }
} catch (Exception $e) {
    $errors = $e->getMessage();
    // include __DIR__ . '/../../../views/error.php';
}
