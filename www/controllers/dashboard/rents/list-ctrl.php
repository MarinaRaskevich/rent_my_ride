<?php
$sectionName = 'Réservations';
$title = 'Réservations';
$rents = null;
$script = 'showModal';

try {
    $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_SPECIAL_CHARS);

    $rentModel = new Rent();

    if ($status) {
        switch ($status) {
            case 'incoming':
                $rents = $rentModel->getRentsWithPreciseStatus('à venir');
                break;
            case 'finished':
                $rents = $rentModel->getRentsWithPreciseStatus('passée');
                break;
            case 'inprogress':
                $rents = $rentModel->getRentsWithPreciseStatus('en cours');
                break;
            case 'all':
                $rents = $rentModel->getAll();
                break;
        }
    } else {
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

renderView('dashboard/rents/list', compact('title', 'sectionName', 'rents', 'script'));
