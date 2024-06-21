<?php
require_once __DIR__ . '/../../../models/Vehicle.php';
require_once __DIR__ . '/../../../models/Category.php';
require __DIR__ . '/../../../helpers/Validator.php';
require __DIR__ . '/../../../helpers/http_helper.php';

$title = 'Création de véhicules';

try {
    $category = new Category();
    $categoryList = $category->getAll();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        ////////// traitement du formulaire ///////////
        ////////////// brand /////////////
        $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        ////////////// model /////////////
        $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        ///////////// registration ///////////
        $registration = filter_input(INPUT_POST, 'registration', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        ///////////// mileage ///////////
        $mileage = filter_input(INPUT_POST, 'mileage', FILTER_SANITIZE_NUMBER_INT);

        ///////////// category ///////////
        $categoryId = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);

        ///////////// picture ///////////
        if (!empty($_FILES['picture']['name'])) {
            if ($_FILES['picture']['type'] != 'image/png') {
                if ($_FILES['picture']['type'] != 'image/jpg') {
                    if ($_FILES['picture']['type'] != 'image/jpeg') {
                        throw new Exception('Le format n\'est pas valide');
                    }
                }
            }

            if ($_FILES['picture']['size'] > MAX_SIZE) {
                throw new Exception('Taille maximale de l\'image: 2 Mo');
            }

            if ($_FILES['picture']['error'] != 0) {
                throw new Exception("Une erreur est survenue");
            }

            $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid('vehicle') . '.' . $extension;
            $file_tmp_name = $_FILES['picture']['tmp_name'];
            $uploads_dir = '/var/www/html/public/uploads/' . $fileName;
            move_uploaded_file($file_tmp_name, $uploads_dir);
        } else {
            $fileName = 'default.png';
        }

        ///////////// created_at ///////////
        $local_timezone = new DateTimeZone("Europe/Paris");
        $creationTime = new DateTime();
        $creationTime->setTimezone($local_timezone);
        $created_at = $creationTime->format('Y-m-d H:i:s');

        $rules = [
            'brand' => 'required|max:50',
            'model' => 'required|max:50',
            'registration' => 'required|regex:registration',
            'mileage' => 'required|regex:mileage',
            'categoryId' => 'required'
        ];

        $data = [
            'brand' => $brand,
            'model' => $model,
            'registration' => $registration,
            'mileage' => $mileage,
            'categoryId' => $categoryId
        ];


        Validator::validate($data, $rules);
        $errors = Validator::getErrors();

        /////// création d'un nouveau objet depuis la classe Vehicle ///////
        if (empty($errors)) {
            $vehicle = new Vehicle($brand, $model, $registration, intval($mileage), $fileName);
            $vehicle->setId_category(intval($categoryId));
            $vehicle->setCreated_at($created_at);
            $isOk = $vehicle->insert();
            if ($isOk != false) {
                header('Location:/controllers/dashboard/vehicles/list-ctrl.php');
                exit;
            }
        }
    }
} catch (\PDOException $e) {
    $errors = $e->getMessage();
    //include __DIR__ . '/../../../views/error.php';
}

renderView('dashboard/vehicles/add', 'dashboard', compact('title', 'categoryList'));
