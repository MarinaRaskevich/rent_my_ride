<?php
$title = 'Rent My Ride';
$script = 'script';

try {
    $currentPage = 1;
    $categoryId = 0;
    $category = new Category();
    $vehicleModel = new Vehicle();
    $categoryList = $category->getAll();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $categoryId = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
        if (!$categoryId) {
            $categoryId = 0;
        }
    }

    //Pagination
    if (isset($_GET['part'])) {
        $currentPage = filter_input(INPUT_GET, 'part', FILTER_SANITIZE_NUMBER_INT);
    }

    //nombre de voitures
    if ($currentPage >= 1 && $categoryId > 0) {
        $currentPage = 1;
        $nbItems = count($vehicleModel->getAll($categoryId));
    } else {
        $nbItems = count($vehicleModel->getAll());
    }
    // nombre d'articles par page
    $nbItemsInOnePage = 8;
    // nombre de pages total
    $pages = ceil($nbItems / $nbItemsInOnePage);

    // Calcul du 1er article de la page
    $firstItem = ($currentPage * $nbItemsInOnePage) - $nbItemsInOnePage;

    $vehiclesList = $vehicleModel->getAll($categoryId, $firstItem, $nbItemsInOnePage);
} catch (\PDOException $e) {
    $error = $e->getMessage();
    renderView('404');
}

renderView('home', compact('title', 'categoryList', 'categoryId', 'vehiclesList', 'currentPage', 'pages', 'script'));
