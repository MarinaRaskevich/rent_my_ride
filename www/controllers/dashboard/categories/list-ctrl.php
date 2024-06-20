<?php
require_once __DIR__ . '/../../../models/Category.php';

$title = 'Catégories';

try {
    $category = new Category();
    $categoryList = $category->getAll();
} catch (\PDOException $e) {
    // include __DIR__ . '/../../../views/error.php';
}

require_once __DIR__ . '/../../../views/dashboard/categories/list.php';
require_once __DIR__ . '/../../../views/dashboard/templates/template.php';
