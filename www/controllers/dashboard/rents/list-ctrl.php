<?php
$sectionName = 'Réservations';
$title = 'Réservations';

try {
    $rentModel = new Rent();
    $rents = $rentModel->getAll();

    foreach ($rents as &$rent) {
        $newStartdate = new DateTime($rent['startdate']);
        $newEnddate = new DateTime($rent['enddate']);
        $rent['startdate'] = $newStartdate->format('d/m/Y');
        $rent['enddate'] = $newEnddate->format('d/m/Y');
    }
} catch (\PDOException $e) {
    $error = $e->getMessage();
    renderView('404');
}

renderView('dashboard/rents/list', compact('title', 'sectionName', 'rents'));
