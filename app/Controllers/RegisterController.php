<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('/auth/register');
    }

    public function store()
    {
        helper(['form']);

        $rules = [
            'username' => 'required|min_length[3]|max_length[20]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'name'     => $this->request->getVar('username'), // sesuaikan ke 'name'
                'email'    => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'), // tidak perlu hash manual, sudah otomatis
                'role' => 'user',
            ];
            
            $model->save($data);
            return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
        } else {
            return view('/auth/register', [
                'validation' => $this->validator
            ]);
        }
    }
}
