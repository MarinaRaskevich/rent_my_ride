<?php

/**
 * Class CategoryController
 *
 * This controller provides common functionality for handling categories.
 */
class CategoryController
{
    /**
     * @var Category The category model instance.
     */
    protected Category $categoryModel;

    /**
     * @var string The name of the section.
     */
    protected string $sectionName = 'Catégorie';

    /**
     * CategoryController constructor.
     *
     * Initializes the category model.
     */
    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    /**
     * Check if the request is a POST request.
     *
     * @return bool True if the request method is POST, false otherwise.
     */
    protected function isPostRequest()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    /**
     * Check if the request is a GET request.
     *
     * @return bool True if the request method is GET, false otherwise.
     */
    protected function isGetRequest(): bool
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    /**
     * Validate the given data against the provided rules.
     *
     * @param array $data The data to validate.
     * @param array $rules The validation rules.
     * @return array The validation errors.
     */
    protected function validateData($data, $rules): array
    {
        Validator::validate($data, $rules);
        return Validator::getErrors();
    }

    /**
     * Add a new category to the database.
     *
     * @param string $categoryName The name of the new category.
     * @return bool True if the category was added successfully, false otherwise.
     */
    protected function addCategory(string $categoryName): bool
    {
        $category = new Category($categoryName);
        return $category->insert();
    }

    /**
     * Update an existing category in the database.
     *
     * @param int $id The ID of the category to update.
     * @param string $categoryName The new name of the category.
     * @return bool True if the category was updated successfully, false otherwise.
     */
    protected function updateCategory(int $id, string $categoryName): bool
    {
        $category = new Category($categoryName);
        $category->setId_category($id);
        return $category->update();
    }

    /**
     * Delete a category from the database.
     *
     * @param int $id The ID of the category to delete.
     * @return bool True if the category was deleted successfully, false otherwise.
     */
    protected function deleteCategory(int $id): bool
    {
        return $this->categoryModel->delete($id);
    }

    /**
     * Retrieve all categories from the database.
     *
     * @return array An array of all categories.
     */
    protected function getAllCategories(): array
    {
        return $this->categoryModel->getAll();
    }

    /**
     * Retrieve a category by its ID.
     *
     * @param int $id The ID of the category to retrieve.
     * @return mixed The category object or false.
     */
    protected function getCategoryById(int $id): mixed
    {
        return $this->categoryModel->getOne($id);
    }

    /**
     * Check if a category exists in the database.
     *
     * @param string $column The column to check.
     * @param string $name The value to check for.
     * @return bool True if the category exists, false otherwise.
     */
    protected function isExist(string $column, string $name): bool
    {
        return $this->categoryModel->isExist($column, $name);
    }

    /**
     * Handle an error by rendering a 404 view.
     *
     * @param string $errorMessage The error message to handle.
     */
    protected function handleError($errorMessage): void
    {
        // $errorMessage;
        renderView('404');
    }
}
