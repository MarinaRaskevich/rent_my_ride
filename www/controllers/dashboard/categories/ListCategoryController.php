<?php

/**
 * Class ListCategoryController
 *
 * This controller handles the listing of categories.
 */
class ListCategoryController extends CategoryController
{
    /**
     * @var string The title of the page.
     */
    private string $title = 'Catégories';

    /**
     * @var string The name of the script to include.
     */
    private string $script = 'showModal';

    /**
     * Handle the incoming request.
     *
     * This method retrieves the list of categories and renders the view with the appropriate data.
     */
    public function handleRequest(): void
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
