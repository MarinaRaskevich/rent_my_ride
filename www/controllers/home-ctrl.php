<?php
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Vehicle.php';

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
    if (isset($_GET['page'])) {
        $currentPage = intval($_GET['page']);
    }

    if (empty($currentPage)) {
        $currentPage = 1;
    }

    //nombre de voitures dans la base de données
    $vehicle = new Vehicle();
    $nbItems = $vehicle->getTotalNumber();
    // nombre d'articles par page
    $nbItemsInOnePage = 8;
    // nombre de pages total
    $pages = ceil($nbItems / $nbItemsInOnePage);
    // Calcul du 1er article de la page
    $firstItem = ($currentPage * $nbItemsInOnePage) - $nbItemsInOnePage;

    $vehiclesList = $vehicle->getAllForClients($categoryId, $firstItem, $nbItemsInOnePage);
} catch (\PDOException $e) {
    //throw $th;
}

require_once __DIR__ . '/../views/home.php';
require_once __DIR__ . '/../views/templates/template.php';
