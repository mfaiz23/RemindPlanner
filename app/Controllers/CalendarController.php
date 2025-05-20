<?php
namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\Controller;

class CalendarController extends BaseController
{
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

        $model = new TaskModel();
        $tasks = $model->where('user_id', $userId)->findAll();

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
                'title' => $task['title'],
                'start' => $task['due_date'],
                // 'url'   => site_url('tasks/detail/' . $task['id']),
                'color' => $color,
                'textColor' => '#ffffff', // Warna teks putih untuk kontras
            ];
        }

        return $this->response->setJSON($events);
    }
}