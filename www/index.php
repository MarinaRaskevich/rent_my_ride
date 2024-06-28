<?php
require_once './config/config.php';
require_once './helpers/Database.php';
require_once './helpers/BaseModel.php';
require_once './helpers/validatorRules/RequiredRule.php';
require_once './helpers/validatorRules/MaxRule.php';
require_once './helpers/validatorRules/RegexRule.php';
require_once './helpers/validatorRules/EmailRule.php';
require_once './helpers/validatorRules/AgeRule.php';
require_once './helpers/Validator.php';
require_once './helpers/http_helper.php';
require_once './models/Category.php';
require_once './models/Vehicle.php';
require_once './models/Client.php';
require_once './models/Rent.php';

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
    'dashboard/home' => 'dashboard/home',
    '', 'home' => 'home',
    'search' => 'search',
    'vehicle/detail' => 'vehicle-detail',
    'booking' => 'booking',
    'booking/message' => 'booking',
        // '404' => '404',
    default => '404'
};


// Router

require_once './controllers/' . $path . '-ctrl.php';
