<?php

class UpdateCategoryController extends CategoryController
{
    private $errors = [];
    private $title = 'Modification d\'une catégories';

    public function handleRequest()
    {
        try {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            if (!$id) {
                throw new Exception('Une erreur est survenue');
            }

            $category = $this->getCategoryById($id);
            if (!$category) {
                throw new Exception('Cette catégorie n\'existe pas');
            }

            if ($this->isPostRequest()) {
                $this->processForm($id);
            }
        } catch (Exception $e) {
            $this->handleError($e->getMessage());
        }

        renderView('dashboard/categories/update', [
            'title' => $this->title,
            'sectionName' => $this->sectionName,
            'category' => $category,
            'errors' => $this->errors,
        ]);
    }

    private function processForm($id)
    {
        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $rules = [
            'categoryName' => 'required|max:50',
        ];

        $data = [
            'categoryName' => $categoryName,
        ];

        $this->errors = $this->validateData($data, $rules);

        if (empty($this->errors)) {
            $isOk = $this->updateCategory($id, $categoryName);
            if ($isOk) {
                addFlash('success', 'Modification effectuée avec succès !');
                redirectToRoute('?page=categories/list');
            }
        }
    }
}

$updateController = new UpdateCategoryController();
$updateController->handleRequest();
