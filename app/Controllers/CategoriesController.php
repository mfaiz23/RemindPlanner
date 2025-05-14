<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class CategoriesController extends ResourceController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new \App\Models\CategoryModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $data['categories'] = $this->categoryModel->where('user_id', $userId)->findAll();

        return view('user/categories/list_categories', $data);
    }

    public function create()
    {
        return view('user/categories/form');
    }

    public function store()
    {
        $userId = session()->get('user_id');

        $this->categoryModel->save([
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'user_id'     => $userId
        ]);

        return redirect()->to('user/categories')->with('success', 'Category created successfully.');
    }

    public function edit($id = null)
    {
        $userId = session()->get('user_id');
        $category = $this->categoryModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$category) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Category not found or not authorized');
        }

        $data['category'] = $category;

        return view('user/categories/form', $data);
    }

    public function update($id = null)
    {
        $userId = session()->get('user_id');
        $category = $this->categoryModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$category) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Category not found or not authorized');
        }

        $this->categoryModel->update($id, [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('user/categories')->with('success', 'Category updated successfully.');
    }

    public function delete($id = null)
    {
        $userId = session()->get('user_id');
        $category = $this->categoryModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$category) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Category not found or not authorized');
        }

        $this->categoryModel->delete($id);

        return redirect()->to('user/categories')->with('success', 'Category deleted successfully.');
    }
}
