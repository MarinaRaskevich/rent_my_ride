<?php
$sectionName = 'Réservations';
$title = 'Réservations';

try {
    $rentModel = new Rent();
    $rents = $rentModel->getAll();

    foreach ($rents as &$rent) {
        // $startdate = strtotime($rent['startdate']);
        // $enddate = strtotime($rent['enddate']);
        // $nowdate = strtotime(date('Y-m-d H:i:s'));

        // if ($startdate > $nowdate && $enddate > $nowdate) {
        //     $rent['status'] = 'À venir';
        // } else if ($startdate < $nowdate && $enddate < $nowdate) {
        //     $rent['status'] = 'Passée';
        // } else if ($startdate < $nowdate && $enddate > $nowdate) {
        //     $rent['status'] = 'En cours';
        // }

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
