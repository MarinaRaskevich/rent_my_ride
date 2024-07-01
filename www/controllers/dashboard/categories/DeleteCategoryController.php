<?php

/**
 * Class DeleteCategoryController
 *
 * This controller handles the deletion of categories.
 */
class DeleteCategoryController extends CategoryController
{
    /**
     * Handle the incoming request.
     *
     * This method processes the deletion of category if the form is submitted via a POST request.
     */
    public function handleRequest(): void
    {
        try {
            if ($this->isPostRequest()) {
                $this->deleteProcess();
            }
        } catch (Exception $e) {
            $this->handleError($e->getMessage());
        }
    }

    /**
     * Process the category deletion.
     *
     * This method validates the category ID, checks for any vehicles associated with the category,
     * and attempts to delete the category if no vehicles are found.
     *
     * @throws Exception If the category does not exist or if the deletion fails.
     */
    private function deleteProcess()
    {
        $id = filter_input(INPUT_POST, 'id_category', FILTER_SANITIZE_NUMBER_INT);

        $category = $this->getCategoryById($id);
        if (!$category) {
            throw new Exception('La catégorie n\'existe pas');
        }

        $vehicleModel = new Vehicle();
        $vehicles = $vehicleModel->getAll($id);
        if ($vehicles) {
            addFlash('danger', 'Erreur: vous ne pouvez pas supprimer la catégorie \'' . $category->name . '\' (il y a ' . count($vehicles) . ' voiture(s) dans cette catégorie)');
            redirectToRoute('?page=categories/list');
        }

        $isOk = $this->categoryModel->delete($id);
        if ($isOk) {
            addFlash('success', 'Suppression effectuée avec succès !');
        } else {
            throw new Exception('La suppression a échoué');
        }

        redirectToRoute('?page=categories/list');
    }
}


$deleteController = new DeleteCategoryController();
$deleteController->handleRequest();
