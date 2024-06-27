<?php

$title = 'Accueil';
$sectionName = 'Accueil';

$vehicleModel = new Vehicle();
$nbVehicles = $vehicleModel->getTotal();

$categoryModel = new Category();
$nbCategories = $categoryModel->getTotal();

$rentModel = new Rent();
$nbCurrentRents = $rentModel->getRentsWithPreciseStatus("en cours");
$nbUpcomingRents = $rentModel->getRentsWithPreciseStatus("à venir");
$nbNonConfirmedRents = $rentModel->getNonConfirmedRents();

$clientModel = new Client();
$nbClients = $clientModel->getTotal();

renderView('dashboard/home', compact('title', 'sectionName', 'nbVehicles', 'nbCategories', 'nbCurrentRents', 'nbUpcomingRents', 'nbNonConfirmedRents', 'nbClients'));
