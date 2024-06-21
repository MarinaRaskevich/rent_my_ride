<?php
require_once __DIR__ . '/../../../models/Category.php';
require __DIR__ . '/../../../helpers/Validator.php';
require __DIR__ . '/../../../helpers/http_helper.php';

$title = 'Modification d\'une catégories';

$id = $_GET['id'] ?? null;
if (is_null($id)) {
    redirectToRoute('/controllers/dashboard/categories/list-ctrl.php');
};


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $categoryName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $rules = [
            'categoryName' => 'required|max:50',
        ];

        $data = [
            'categoryName' => $categoryName,
        ];

        Validator::validate($data, $rules);
        $errors = Validator::getErrors();

        if (empty($errors)) {
            $category = new Category($categoryName);
            $category->setId_category($id);
            $isOk = $category->update();
            if ($isOk != false) {
                redirectToRoute('/controllers/dashboard/categories/list-ctrl.php');
            }
        }
    } catch (\PDOException $e) {
        $errors = $e->getMessage();
        // include __DIR__ . '/../../../views/error.php';
    }
}

try {
    $categoryModel = new Category();
    $category = $categoryModel->getOne($id);
} catch (\PDOException $th) {
    //throw $th;
}

renderView('dashboard/categories/update', compact('title', 'category'));
