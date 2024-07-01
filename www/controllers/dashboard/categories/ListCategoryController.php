<?php

class ListCategoryController extends CategoryController
{
    private $title = 'Catégories';
    private $script = 'showModal';

    public function handleRequest()
    {
        try {
            $categoryList = $this->categoryModel->getAll();
            if (!$categoryList) {
                throw new Exception('Une erreur s\'est produite lors de la récupération des données');
            }
        } catch (\PDOException $e) {
            $this->handleError($e->getMessage());
        }

        renderView('dashboard/categories/list', [
            'title' => $this->title,
            'sectionName' => $this->sectionName,
            'categoryList' => $categoryList,
            'script' => $this->script,
        ]);
    }
}


$listController = new ListCategoryController();
$listController->handleRequest();
