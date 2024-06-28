<?php

$title = 'Modification d\'un véhicule';
$sectionName = 'Véhicules';
$script = 'deleteElement';
$errors = [];
$data = [];

try {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if (!$id) {
        throw new Exception('Une erreur est survenue');
    };

    $category = new Category();
    $categoryList = $category->getAll();

    $vehicle = new Vehicle();
    $oneVehicle = $vehicle->getOne($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        ////////// traitement du formulaire ///////////
        $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $registration = filter_input(INPUT_POST, 'registration', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mileage = filter_input(INPUT_POST, 'mileage', FILTER_SANITIZE_NUMBER_INT);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
        $categoryId = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $existingPicture = filter_input(INPUT_POST, 'existingPicture', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $isDeleted = filter_input(INPUT_POST, 'isDeleted', FILTER_SANITIZE_NUMBER_INT);

        //L'utilisateur a supprimé l'image et n'a pas téléchargé de nouvelle image
        if (empty($_FILES['picture']['name']) && $isDeleted === '1') {
            $fileName = 'default.png';
            $filepath = '/var/www/html/public/uploads/' . $existingPicture;
            unlink($filepath);
        }

        //L'utilisateur n'a pas téléchargé l'image et a laissé l'ancienne
        if (empty($_FILES['picture']['name']) && $isDeleted === '0') {
            $fileName = $existingPicture;
        }

        //L'utilisateur n'a pas téléchargé d'image et a laissé l'image par défaut
        if (empty($_FILES['picture']['name']) && $existingPicture === 'default.png') {
            $fileName = 'default.png';
        }

        //L'utilisateur a téléchargé une nouvelle image
        if ($_FILES['picture']['name'] !== '' && $isDeleted === '1') {
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

            if ($existingPicture != 'default.png') {
                $filepath = '/var/www/html/public/uploads/' . $existingPicture;
                unlink($filepath);
            }
        }

        /////////// updated_at ///////////
        $local_timezone = new DateTimeZone("Europe/Paris");
        $updateTime = new DateTime();
        $updateTime->setTimezone($local_timezone);
        $updated_at = $updateTime->format('Y-m-d H:i:s');

        $rules = [
            'brand' => 'required|max:50',
            'model' => 'required|max:50',
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

        /// création d'un nouveau objet depuis la classe Vehicle ///////
        if (empty($errors)) {
            $vehicle = new Vehicle($brand, $model, $registration, intval($mileage), $fileName, $price);
            $vehicle->setId_category(intval($categoryId));
            $vehicle->setUpdated_at($updated_at);
            $vehicle->setId_vehicle(intval($id));
            $isOk = $vehicle->update();
            if ($isOk) {
                addFlash('success', 'Modification effectué avec succès !');
                redirectToRoute('?page=vehicles/list');
            }
        }
    }
} catch (Exception $e) {
    $error = $e->getMessage();
    renderView('404');
}


renderView('dashboard/vehicles/update', compact('title', 'oneVehicle', 'categoryList', 'sectionName', 'errors', 'data', 'script'));
