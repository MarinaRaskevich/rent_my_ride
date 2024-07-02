<?php
$title = 'Rent My Ride';
$script = 'script';

try {
    $category = new Category();
    $categoryList = $category->getAll();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $categoryId = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!$categoryId) {
            $categoryId = 'all';
        }
    }

    if (!isset($categoryId)) {
        $categoryId = 'all';
    }

    //Pagination
    if (isset($_GET['part'])) {
        $currentPage = intval($_GET['part']);
    }

    if (empty($currentPage)) {
        $currentPage = 1;
    }

    //nombre de voitures dans la base de données
    $vehicleModel = new Vehicle();
    if ($categoryId === 'all') {
        $nbItems = $vehicleModel->getTotal();
    } else {
        $nbItems = $vehicleModel->getTotalNumber(intval($categoryId));
    }
    // nombre d'articles par page
    $nbItemsInOnePage = 8;
    // nombre de pages total
    $pages = ceil($nbItems / $nbItemsInOnePage);
    // Calcul du 1er article de la page
    $firstItem = ($currentPage * $nbItemsInOnePage) - $nbItemsInOnePage;

    $vehiclesList = $vehicleModel->getAllForClients($categoryId, $firstItem, $nbItemsInOnePage);
} catch (\PDOException $e) {
    $error = $e->getMessage();
    renderView('404');
}

renderView('home', compact('title', 'categoryList', 'categoryId', 'vehiclesList', 'currentPage', 'pages', 'script'));
