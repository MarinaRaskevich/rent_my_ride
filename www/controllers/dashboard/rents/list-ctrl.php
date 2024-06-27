<?php
$sectionName = 'Réservations';
$title = 'Réservations';
$rents = null;

try {
    $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($status) {
        switch ($status) {
            case 'incoming':
                $rentModel = new Rent();
                $rents = $rentModel->getRentsWithPreciseStatus('à venir');
                break;
            case 'finished':
                $rentModel = new Rent();
                $rents = $rentModel->getRentsWithPreciseStatus('passée');
                break;
            case 'inprogress':
                $rentModel = new Rent();
                $rents = $rentModel->getRentsWithPreciseStatus('en cours');
                break;
            case 'all':
                $rentModel = new Rent();
                $rents = $rentModel->getAll();
                break;
        }
    } else {
        $rentModel = new Rent();
        $rents = $rentModel->getAll();
    }

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
    var_dump($error);
    // renderView('404');
}

renderView('dashboard/rents/list', compact('title', 'sectionName', 'rents'));
