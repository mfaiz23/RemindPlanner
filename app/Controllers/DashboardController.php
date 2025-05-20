<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class DashboardController extends ResourceController
{
    /**
     * Return user dashboard
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');
    
        $taskModel = new \App\Models\TaskModel();
        $categoryModel = new \App\Models\CategoryModel();
    
        $totalTasks = $taskModel->where('user_id', $userId)->countAllResults();
        $totalCategories = $categoryModel->where('user_id', $userId)->countAllResults();
    
        $data = [
            'total_tasks' => $totalTasks,
            'total_categories' => $totalCategories,
            'role' => $session->get('role'),
            'logged_in' => $session->get('logged_in'),
        ];
    
        return view('user/dashboard/user', $data);
    }
    

    /**
     * Return admin dashboard
     *
     * @return ResponseInterface
     */
    public function admin()
{
    $session = session();
    $userModel = new \App\Models\UserModel();
    $taskModel = new \App\Models\TaskModel(); // ← Tambahkan ini
    
    // Get statistics for admin dashboard
    $totalUsers = $userModel->countAll();
    $newUsers = $userModel->where('created_at >=', date('Y-m-d', strtotime('-30 days')))->countAllResults();
    
    $data = [
        'role' => $session->get('role'),
        'logged_in' => $session->get('logged_in'),
        'total_users' => $totalUsers,
        'new_users' => $newUsers,
        'total_tasks_user' => $taskModel->countAll(), // ← Pakai variabel yang sudah dibuat
    ];

    return view('admin/dashboard', $data);
}


    // ... (keep the rest of the methods as they are)
}