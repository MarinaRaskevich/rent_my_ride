<?php

try {
    $id = $_GET['id'];
    $category = new Category();
    $isOk = $category->delete($id);
    if ($isOk != false) {
        redirectToRoute('?page=categories/list');
    }
} catch (Exception $e) {
    $errors = $e->getMessage();
    // include __DIR__ . '/../../../views/error.php';
}
