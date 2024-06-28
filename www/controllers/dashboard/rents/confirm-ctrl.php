<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id = filter_input(INPUT_POST, 'id_rent', FILTER_SANITIZE_NUMBER_INT);
        $rentModel = new Rent();
        $today = date('Y-m-d H:i:s');
        $rentModel->setConfirmed_at($today);
        $isOk = $rentModel->setConfirmDate($id);

        if ($isOk != false) {
            $rentInfo = $rentModel->getOne($id);
            $rentInfo['startdate'] = new DateTime($rentInfo['startdate']);
            $rentInfo['enddate'] = new DateTime($rentInfo['enddate']);
            // $isOkMail = sendMail($rentInfo['email'], $rentInfo['clientName'], $rentInfo['startdate']->format('d/m/Y'), $rentInfo['enddate']->format('d/m/Y'), $rentInfo['vehicleName']);
            $isOkMail = sendMail('marina.raskevich19@gmail.com', $rentInfo['clientName'], $rentInfo['startdate']->format('d/m/Y'), $rentInfo['enddate']->format('d/m/Y'), $rentInfo['vehicleName']);
            var_dump($isOkMail);

            if ($isOkMail) {
                addFlash('success', 'Confirmation effectué avec succès !');
                redirectToRoute('?page=rents/list');
            }
        } else {
            renderView('404');
        }
    } catch (\Exception $e) {
        $error = $e->getMessage();
        renderView('404');
    }
}
