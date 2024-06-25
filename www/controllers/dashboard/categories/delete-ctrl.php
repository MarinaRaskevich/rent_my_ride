<?php

try {
    $id = $_GET['id'];
    $category = new Category();
    $isOk = $category->delete($id);
    if ($isOk != false) {
        redirectToRoute('?page=categories/list');
    } else {
        throw new Exception('Une erreur est survenue');
    }
} catch (Exception $e) {
    $errors = $e->getMessage();
    renderView('404');
}
