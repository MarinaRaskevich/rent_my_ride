<?php
$sectionName = 'Catégorie';

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
                    addFlash('success', "La catégorie $newCategoryName a été ajoutée avec succès!");
                    redirectToRoute('?page=categories/list');
                }
            } else {
                addFlash('danger', "Cette catégorie existe déjà dans votre base de données");
            }
        }
    }
} catch (Exception $e) {
    $errors = $e->getMessage();
    // include __DIR__ . '/../../../views/error.php';
}

$title = "Création de catégorie";

renderView('dashboard/categories/add', compact('title', 'sectionName'));
