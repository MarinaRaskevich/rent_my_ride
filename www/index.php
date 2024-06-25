<?php
// // helpers
// require_once './helpers/http_helper.php';

// démarrage session
session_start();

// Import des contrôleurs

$page = $_GET['page'] ?? '';

$page = filter_var($page, FILTER_SANITIZE_SPECIAL_CHARS);

$path = match ($page) {
    'categories/list' => 'dashboard/categories/list',
    'categories/add' => 'dashboard/categories/add',
    'categories/update' => 'dashboard/categories/update',
    'categories/delete' => 'dashboard/categories/delete',
    'vehicles/list' => 'dashboard/vehicles/list',
    'vehicles/add' => 'dashboard/vehicles/add',
    'vehicles/update' => 'dashboard/vehicles/update',
    'vehicles/delete' => 'dashboard/vehicles/delete',
    'rents/list' => 'dashboard/rents/list',
    'clients/list' => 'dashboard/clients/list',
    'dashboard/home' => 'dashboard/home',
    '', 'home' => 'home',
    'vehicle/detail' => 'vehicle-detail',
    'booking' => 'booking',
    default => '404'
};


// Router

require_once './controllers/' . $path . '-ctrl.php';
