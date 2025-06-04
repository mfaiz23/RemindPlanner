<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class UserListController extends ResourceController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('admin/user_list', $data);
    }

    public function delete($id = null)
    {
        if (!$id) {
            return redirect()->to('admin/users')->with('error', 'User  ID is required.');
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User  not found.');
        }

        // Hapus user
        $this->userModel->delete($id);
        return redirect()->to('admin/users')->with('success', 'User  deleted successfully.');
    }
}
