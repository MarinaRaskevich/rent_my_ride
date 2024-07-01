<?php

/**
 * Class AddCategoryController
 *
 * This controller handles the creation of new categories.
 */
class AddCategoryController extends CategoryController
{
    /**
     * @var array An array to hold any validation errors.
     */
    private array $errors = [];

    /**
     * @var array An array to hold form data.
     */
    private array $data = [];

    /**
     * @var string The title of the page.
     */
    private string $title = "Création de catégorie";

    /**
     * Handle the incoming request.
     *
     * This method processes the form if the request is a POST request,
     * and renders the view with the appropriate data.
     */
    public function handleRequest(): void
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

    /**
     * Process the form data.
     *
     * This method sanitizes the input, validates the data, and
     * attempts to save the new category if the data is valid.
     */
    private function processForm(): void
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

    /**
     * Save the new category to the database.
     *
     * This method checks if the category already exists, and if not,
     * adds the new category to the database.
     *
     * @param string $newCategoryName The name of the new category.
     */
    private function saveCategory(string $newCategoryName): void
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
