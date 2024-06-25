<?php
$sectionName = 'Catégorie';
$title = 'Catégories';

try {
    $category = new Category();
    $categoryList = $category->getAll();
} catch (\PDOException $e) {
    // include __DIR__ . '/../../../views/error.php';
}


renderView('dashboard/categories/list', compact('title', 'categoryList', 'sectionName'));
