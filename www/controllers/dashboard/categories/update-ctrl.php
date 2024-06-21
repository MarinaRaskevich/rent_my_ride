<?php
require_once __DIR__ . '/../../../models/Category.php';
require __DIR__ . '/../../../helpers/Validator.php';
require __DIR__ . '/../../../helpers/http_helper.php';

$title = 'Modifier la catégories';

try {
    $id = intval($_GET['id']);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                header('Location: /controllers/dashboard/categories/list-ctrl.php');
                exit;
            }
        }
    }

    $category = new Category();
    $oneName = $category->getOne($id);
} catch (\PDOException $e) {
    $errors = $e->getMessage();
    // include __DIR__ . '/../../../views/error.php';
}

renderView('dashboard/categories/update', 'dashboard', compact('title', 'oneName'));
