<?php

class CategoryController
{
    protected $categoryModel;
    protected $sectionName = 'Catégorie';

    public function __construct()
    {
        $this->categoryModel = new Category();
    }


    protected function isPostRequest()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected function isGetRequest()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    protected function validateData($data, $rules)
    {
        Validator::validate($data, $rules);
        return Validator::getErrors();
    }

    protected function addCategory($categoryName)
    {
        $category = new Category($categoryName);
        return $category->insert();
    }

    protected function updateCategory($id, $categoryName)
    {
        $category = new Category($categoryName);
        $category->setId_category($id);
        return $category->update();
    }

    protected function deleteCategory($id)
    {
        return $this->categoryModel->delete($id);
    }

    protected function getAllCategories()
    {
        return $this->categoryModel->getAll();
    }

    protected function getCategoryById($id)
    {
        return $this->categoryModel->getOne($id);
    }

    protected function isExist($column, $name)
    {
        return $this->categoryModel->isExist($column, $name);
    }

    protected function handleError($errorMessage)
    {
        // $errorMessage;
        renderView('404');
    }
}
