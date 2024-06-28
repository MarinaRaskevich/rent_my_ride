<?php
$sectionName = 'Catégorie';
$title = 'Catégories';
$script = 'showModal';

try {
    $category = new Category();
    $categoryList = $category->getAll();
} catch (\PDOException $e) {
    $error = $e->getMessage();
    renderView('404');
}


renderView('dashboard/categories/list', compact('title', 'categoryList', 'sectionName', 'script'));
