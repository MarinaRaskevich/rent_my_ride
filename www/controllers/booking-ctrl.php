<?php
$title = "Réservation";
$script = 'citiesApi';
$errors =  [];

try {
    if (!isset($_GET['id'])) {
        // throw new Exception("Cette voiture n'existe pas");
        redirectToRoute('home');
    };

    $id_vehicle = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $vehicleModel = new Vehicle();
    $vehicle = $vehicleModel->getOne($id_vehicle);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        ////////// traitement du formulaire ///////////
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
        $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
        $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_NUMBER_INT);
        $startdate = filter_input(INPUT_POST, 'startdate', FILTER_SANITIZE_NUMBER_INT);
        $enddate = filter_input(INPUT_POST, 'enddate', FILTER_SANITIZE_NUMBER_INT);

        ///////////// created_at ///////////
        // $local_timezone = new DateTimeZone("Europe/Paris");
        // $creationTime = new DateTime();
        // $creationTime->setTimezone($local_timezone);
        // $created_at = $creationTime->format('Y-m-d H:i:s');

        $startdate = new Datetime($startdate);
        $startdate = date_format($startdate, 'Y-m-d');
        $enddate = new Datetime($enddate);
        $enddate = date_format($enddate, 'Y-m-d');

        $rules = [
            'lastname' => 'required|max:50|regex:REGEX_NAME',
            'firstname' => 'required|max:50|regex:REGEX_NAME',
            'birthdate' => 'required|regex:REGEX_DATE|age',
            'email' => 'required|max:255|email',
            'phone' => 'required|regex:REGEX_PHONE',
            'city' => 'required|max:100',
            'zipcode' => 'required|regex:REGEX_ZIPCODE',
            'startdate' => 'required|regex:REGEX_DATE',
            'enddate' => 'required|regex:REGEX_DATE'
        ];

        $data = [
            'lastname' => $lastname,
            'firstname' => $firstname,
            'birthdate' => $birthdate,
            'email' => $email,
            'phone' => $phone,
            'city' => $city,
            'zipcode' => $zipcode,
            'startdate' => $startdate,
            'enddate' => $enddate
        ];


        Validator::validate($data, $rules);
        $errors = Validator::getErrors();

        if (empty($errors)) {
            $clientModel = new Client($lastname, $firstname, $email, $phone, $city, $zipcode);
            $clientModel->getDb()->beginTransaction();
            //désactive le mode autocommit. Lorsque l'autocommit est désactivé, les modifications faites sur la base de données via les instances des objets PDO ne sont pas appliquées tant que vous ne mettez pas fin à la transaction en appelant la fonction PDO::commit(). 
            $clientModel->setBirthday($birthdate);
            $isOkClient = $clientModel->insert();
            $id_client = $clientModel->getLastInsertId();

            $rent = new Rent(new DateTime($startdate), new DateTime($enddate), $id_vehicle, $id_client, 'à venir');
            $isOkRent = $rent->insert();

            if ($isOkRent && $isOkClient) {
                $clientModel->getDb()->commit();
                renderView('booking-message', compact('title', 'vehicle'));
            } else {
                $clientModel->getDb()->rollback();
                throw new Exception('Une erreur s\'est produite');
            }
        }
    }
} catch (\Exception $e) {
    $error = $e->getMessage();
    var_dump($error);
    // renderView('404');
}

renderView('booking', compact('title', 'vehicle', 'errors', 'script'));
