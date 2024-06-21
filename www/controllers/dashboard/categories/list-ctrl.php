<?php
require_once __DIR__ . '/../../../models/Category.php';
require __DIR__ . '/../../../helpers/http_helper.php';

$title = 'Catégories';

try {
    $category = new Category();
    $categoryList = $category->getAll();
} catch (\PDOException $e) {
    // include __DIR__ . '/../../../views/error.php';
}


renderView('dashboard/categories/list', 'dashboard', compact('title', 'categoryList'));
