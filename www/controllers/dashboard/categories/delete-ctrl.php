<?php
require_once __DIR__ . '/../../../models/Category.php';

$title = 'Catégories';

try {
    $id = $_GET['id'];
    $category = new Category();
    $isOk = $category->delete($id);
    if ($isOk != false) {
        header('Location:/controllers/dashboard/categories/list-ctrl.php');
        exit;
    }
} catch (Exception $e) {
    $errors = $e->getMessage();
    // include __DIR__ . '/../../../views/error.php';
}
