<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class TaskListController extends ResourceController
{
    protected $taskModel;


/**
 * Constructor for TaskListController.
 * 
 * Initializes the TaskModel instance to interact with task-related data.
 */


    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    /**
     * Menampilkan daftar tugas dari semua pengguna
     *
     * @return ResponseInterface
     */
    public function index()
    {
        // Ambil semua data tugas dengan informasi pengguna
        $date = date('Y-m-d'); // Atur tanggal sesuai kebutuhan
        $data['tasks'] = $this->taskModel->getTasksWithUserInfoAdmin();

        // Tampilkan view dengan data tugas
        return view('admin/task_list', $data);
    }
}
