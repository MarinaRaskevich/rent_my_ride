<?php

class AddCategoryController extends CategoryController
{
    private $errors = [];
    private $data = [];
    private $title = "Création de catégorie";

    public function handleRequest()
    {
        try {
            if ($this->isPostRequest()) {
                $this->processForm();
            }
        } catch (\PDOException $ex) {
            $this->handleError($ex->getMessage());
        }

        renderView('dashboard/categories/add', [
            'title' => $this->title,
            'sectionName' => $this->sectionName,
            'errors' => $this->errors,
            'data' => $this->data,
        ]);
    }

    private function processForm()
    {
        $newCategoryName = filter_input(INPUT_POST, 'newCategoryName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $rules = [
            'newCategoryName' => 'required|max:50',
        ];

        $this->data = [
            'newCategoryName' => $newCategoryName,
        ];

        $this->errors = $this->validateData($this->data, $rules);

        if (empty($this->errors)) {
            $this->saveCategory($newCategoryName);
        }
    }

    private function saveCategory($newCategoryName)
    {
        $isExist = $this->isExist('name', $newCategoryName);
        if (!$isExist) {
            $isOk = $this->addCategory($newCategoryName);
            if ($isOk) {
                addFlash('success', "La catégorie $newCategoryName a été ajoutée avec succès!");
                redirectToRoute('?page=categories/list');
            }
        } else {
            addFlash('danger', "Cette catégorie existe déjà dans votre base de données");
        }
    }
}

$addController = new AddCategoryController();
$addController->handleRequest();
