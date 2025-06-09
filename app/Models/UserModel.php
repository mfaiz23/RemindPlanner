<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'google_id', 'role', 'profile_image'];
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function updateProfile($id, $data)
    {
        // Remove password from data if it's empty
        if (empty($data['password'])) {
            unset($data['password']);
        }
        
        return $this->update($id, $data);
    }

    public function verifyPassword($id, $password)
    {
        $user = $this->find($id);
        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }
}
