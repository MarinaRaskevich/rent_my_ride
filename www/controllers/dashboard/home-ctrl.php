<?php
require __DIR__ . '/../../helpers/http_helper.php';

$title = 'Accueil';


renderView('dashboard/home', 'dashboard', compact('title'));
