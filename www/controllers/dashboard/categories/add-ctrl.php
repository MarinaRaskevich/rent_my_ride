<?php
require_once __DIR__ . '/../../../models/Category.php';
require __DIR__ . '/../../../helpers/Validator.php';

$title = 'Catégories';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $newCategoryName = filter_input(INPUT_POST, 'newCategoryName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $rules = [
            'newCategoryName' => 'required|max:50',
        ];

        $data = [
            'newCategoryName' => $newCategoryName,
        ];

        Validator::validate($data, $rules);
        $errors = Validator::getErrors();

        if (empty($errors)) {
            $category = new Category();
            $isExiste = $category->isExiste($newCategoryName);
            if (!$isExiste) {
                $category = new Category($newCategoryName);
                $isOk = $category->insert();
                if ($isOk) {
                    header('Location:/controllers/dashboard/categories/list-ctrl.php');
                    exit;
                }
            } else {
                $errors['newCategoryName'][] =  'Сette catégorie existe déjà dans votre base de données';
            }
        }
    }
} catch (Exception $e) {
    $errors = $e->getMessage();
    // include __DIR__ . '/../../../views/error.php';
}

require_once __DIR__ . '/../../../views/dashboard/categories/add.php';
require_once __DIR__ . '/../../../views/dashboard/templates/template.php';
