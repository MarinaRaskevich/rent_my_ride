<?php
$title = "Réservation";
$script = 'citiesApi';

try {
    if (!isset($_GET['id'])) {
        throw new Exception("Cette voiture n'existe pas");
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

        $rules = [
            'lastname' => 'required|max:50|regex:REGEX_NAME',
            'firstname' => 'required|max:50|regex:REGEX_NAME',
            'birthdate' => 'required|regex:REGEX_DATE',
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
            $pdo = Database::dbConnect();
            $pdo->beginTransaction(); //désactive le mode autocommit. Lorsque l'autocommit est désactivé, les modifications faites sur la base de données via les instances des objets PDO ne sont pas appliquées tant que vous ne mettez pas fin à la transaction en appelant la fonction PDO::commit(). 
            $client = new Client($lastname, $firstname, $email, $phone, $city, $zipcode);
            $client->setBirthday($birthdate);
            $isOkClient = $client->insert();
            $id_client = $client->getLastInsertId();

            $rent = new Rent(new DateTime($startdate), new DateTime($enddate), $id_vehicle, $id_client);
            $isOkRent = $rent->insert();

            if ($isOkRent && $isOkClient) {
                $pdo->commit();
                renderView('booking-message', compact('title', 'vehicle'));
            } else {
                $pdo->rollback();
                throw new Exception('Une erreur s\'est produite');
            }
        }
    }
} catch (\Exception $e) {
    $error = $e->getMessage();
    var_dump($error);
    // renderView('404');
}

renderView('booking', compact('title', 'vehicle', 'script'));
