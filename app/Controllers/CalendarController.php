<?php
namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\CategoryModel;
use CodeIgniter\Controller;

class CalendarController extends BaseController
{
    protected $taskModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        return view('user/calendar/calendartest');
    }

    public function events()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            return $this->response->setJSON([]);
        }

        // Ambil data task beserta kategori terkait
        $tasks = $this->taskModel
            ->select('tasks.*, categories.name as category_name')
            ->join('categories', 'categories.id = tasks.c_id', 'left')
            ->where('tasks.user_id', $userId)
            ->findAll();

        $events = [];

        foreach ($tasks as $task) {
            // Tentukan warna berdasarkan status
            $color = '';
            switch ($task['status']) {
                case 'pending':
                    $color = '#ffc107'; // Kuning
                    break;
                case 'in_progress':
                    $color = '#0dcaf0'; // Cyan
                    break;
                case 'completed':
                    $color = '#198754'; // Hijau
                    break;
                case 'cancelled':
                    $color = '#dc3545'; // Merah
                    break;
                default:
                    $color = '#6c757d'; // Abu-abu default
            }

            $events[] = [
                'id' => $task['id'], 
                'title' => $task['title'],
                'start' => $task['due_date'],
                'color' => $color,
                'textColor' => '#ffffff',
                'extendedProps' => [
                    'description' => $task['description'] ?? '',
                    'status' => $task['status'] ?? 'No status',
                    'category_name' => $task['category_name'] ?? 'No category',
                    'taskId' => $task['id']
                ]
            ];
        }

        return $this->response->setJSON($events);
    }
}