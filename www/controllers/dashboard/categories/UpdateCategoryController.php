<?php

/**
 * Class UpdateCategoryController
 *
 * This controller handles the updating of existing categories.
 */
class UpdateCategoryController extends CategoryController
{
    /**
     * @var array An array to hold any validation errors.
     */
    private array $errors = [];

    /**
     * @var string The title of the page.
     */
    private string $title = 'Modification d\'une catégories';

    /**
     * Handle the incoming request.
     *
     * This method checks for the category ID in the GET parameters, retrieves the category under that ID, processes the form if it is submitted via a POST request, and displays the view with the corresponding data.
     *
     * @throws Exception If the category ID is missing or invalid, or if the category under that ID does not exist.
     */
    public function handleRequest(): void
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

    /**
     * Process the form data for updating the category.
     *
     * This method sanitizes the input, validates the data, and
     * attempts to update the category if the data is valid.
     *
     * @param int $id The ID of the category to update.
     */
    private function processForm(int $id): void
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
