<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class UserController extends ResourceController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $session = session();
        $data = [
            'role' => $session->get('role'), // Kirim role ke view
            'logged_in' => $session->get('logged_in')
        ];
        return view('user/dashboard/user', $data);
    }

    /**
     * Show edit profile form
     */
    public function editProfile()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = $session->get('user_id');
        $user = $this->userModel->find($userId);

        $data = [
            'user' => $user,
            'role' => $session->get('role'),
            'logged_in' => $session->get('logged_in')
        ];

        return view('user/profile/edit', $data);
    }

    /**
     * Update user profile
     */
    public function updateProfile()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = $session->get('user_id');
        $validation = \Config\Services::validation();

        // Validation rules
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
        ];

        // Add password validation if password is being changed
        if ($this->request->getPost('new_password')) {
            $rules['current_password'] = 'required';
            $rules['new_password'] = 'required|min_length[6]';
            $rules['confirm_password'] = 'required|matches[new_password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'name' => $this->request->getPost('name')
        ];

        // Handle password change
        if ($this->request->getPost('new_password')) {
            $currentPassword = $this->request->getPost('current_password');
            
            if (!$this->userModel->verifyPassword($userId, $currentPassword)) {
                return redirect()->back()->withInput()->with('error', 'Password saat ini tidak benar');
            }
            
            $updateData['password'] = $this->request->getPost('new_password');
        }

        // Handle file upload
        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validationRules = [
                'profile_image' => 'uploaded[profile_image]|is_image[profile_image]|max_size[profile_image,2048]'
            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Create uploads directory if it doesn't exist
            $uploadPath = WRITEPATH . 'uploads/profile/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Generate unique filename
            $newName = $file->getRandomName();
            
            if ($file->move($uploadPath, $newName)) {
                $updateData['profile_image'] = $newName;
                
                // Delete old profile image if exists
                $currentUser = $this->userModel->find($userId);
                if ($currentUser['profile_image'] && file_exists($uploadPath . $currentUser['profile_image'])) {
                    unlink($uploadPath . $currentUser['profile_image']);
                }
            }
        }

        // Update user data
        if ($this->userModel->updateProfile($userId, $updateData)) {
            // Update session data
            $updatedUser = $this->userModel->find($userId);
            $session->set([
                'name' => $updatedUser['name'],
                'profile_image' => $updatedUser['profile_image']
            ]);

            return redirect()->to('/user/profile/edit')->with('success', 'Profile berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui profile');
        }
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}
