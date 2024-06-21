<?php
// // helpers
// require_once './helpers/http_helper.php';

// $page = $_GET['page'] ?? '';

// $page = filter_var($page, FILTER_SANITIZE_SPECIAL_CHARS);

// $path = match ($page) {
//     '' => 'dashboard/categories/list',
//     'categories/add' => 'dashboard/categories/add',
//     'categories/update' => 'dashboard/categories/update',
//     'categories/delete' => 'dashboard/categories/delete',
//     default => '404'
// };


// Router

// dashboard/categories/add

// require_once './controllers/' . $path . '-ctrl.php';
require_once './controllers/clients/home-ctrl.php';
