<?php

$title = 'Création de véhicules';
$sectionName = 'Véhicules';
$errors = [];
$data = [];

try {
    $categoryModel = new Category();
    $categoryList = $categoryModel->getAll();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        ////////// traitement du formulaire ///////////
        $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $registration = filter_input(INPUT_POST, 'registration', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mileage = filter_input(INPUT_POST, 'mileage', FILTER_SANITIZE_NUMBER_INT);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
        $categoryId = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);


        if (!$categoryModel->isExist('id', $categoryId)) {
            throw new Exception('Cette catégorie est inconnue');
        }

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
            if (!move_uploaded_file($file_tmp_name, $uploads_dir)) {
                $fileName = 'default.png';
            };
        } else {
            $fileName = 'default.png';
        }

        ///////////// created_at ///////////
        // $local_timezone = new DateTimeZone("Europe/Paris");
        // $creationTime = new DateTime();
        // $creationTime->setTimezone($local_timezone);
        // $created_at = $creationTime->format('Y-m-d H:i:s');

        $rules = [
            'brand' => 'required|max:50|regex:REGEX_NAME',
            'model' => 'required|max:50|regex:REGEX_NAME',
            'registration' => 'required|regex:REGEX_REGISTRATION',
            'mileage' => 'required|regex:REGEX_MILEAGE',
            'price' => 'required',
            'categoryId' => 'required'
        ];

        $data = [
            'brand' => $brand,
            'model' => $model,
            'registration' => $registration,
            'mileage' => $mileage,
            'price' => $price,
            'categoryId' => $categoryId
        ];


        Validator::validate($data, $rules);
        $errors = Validator::getErrors();

        /////// création d'un nouveau objet depuis la classe Vehicle ///////
        if (empty($errors)) {
            $vehicle = new Vehicle($brand, $model, $registration, intval($mileage), $fileName, $price);
            $vehicle->setId_category(intval($categoryId));
            // $vehicle->setCreated_at($created_at);
            $isOk = $vehicle->insert();
            if ($isOk != false) {
                addFlash('success', "Le véhicule $brand $model a été ajouté avec succès!");
                redirectToRoute('?page=vehicles/list');
            }
        }
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    renderView('404');
}

renderView('dashboard/vehicles/add', compact('title', 'categoryList', 'sectionName', 'errors', 'data'));
