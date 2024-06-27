<?php

$title = 'Accueil';
$sectionName = 'Accueil';

$vehicleModel = new Vehicle();
$nbVehicles = $vehicleModel->getTotal();

$categoryModel = new Category();
$nbCategories = $categoryModel->getTotal();

$rentModel = new Rent();
$nbRents = $rentModel->getTotal();

$clientModel = new Client();
$nbClients = $clientModel->getTotal();

renderView('dashboard/home', compact('title', 'sectionName', 'nbVehicles', 'nbCategories', 'nbRents', 'nbClients'));
