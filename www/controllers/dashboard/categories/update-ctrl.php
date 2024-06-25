<?php

$sectionName = 'Catégorie';
$title = 'Modification d\'une catégories';
$errors = null;

try {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if (!$id) {
        throw new Exception('Une erreur est survenue');
    };

    $categoryModel = new Category();
    if (!$categoryModel->getOne($id)) {
        throw new Exception('Cette catégorie n\'existe pas');
    };

    $category = $categoryModel->getOne($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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
                addFlash('success', 'Modification effectué avec succès !');
                redirectToRoute('?page=categories/list');
            }
        }
    }
} catch (\PDOException $e) {
    $error = $e->getMessage();
    renderView('404');
} catch (Exception $e) {
    $error = $e->getMessage();
    renderView('404');
}

renderView('dashboard/categories/update', compact('title', 'category', 'sectionName', 'errors'));
