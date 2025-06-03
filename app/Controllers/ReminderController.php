<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\TaskModel;
use App\Models\UserModel;

class ReminderController extends ResourceController
{
    public function sendDailyReminders()
    {
        $taskModel = new TaskModel();
        $userModel = new UserModel();
        $email = \Config\Services::email(); // Menggunakan service email CodeIgniter

        // Tentukan batas waktu untuk pengingat (1 hari dari sekarang)
        $today = date('Y-m-d');
        $dueDateLimit = date('Y-m-d', strtotime("+1 day")); // Tasks yang due_date-nya besok

        // Ambil tasks yang statusnya 'pending' dan due_date-nya dalam 1 hari ke depan
        $upcomingTasks = $taskModel->where('status', 'pending')
                                   ->where('due_date >=', $today)
                                   ->where('due_date <=', $dueDateLimit)
                                   ->findAll();

        if (!empty($upcomingTasks)) {
            foreach ($upcomingTasks as $task) {
                // Ambil data user yang memiliki task ini
                $user = $userModel->find($task['user_id']);

                if ($user && isset($user['email']) && !empty($user['email'])) {
                    $email->clear(); // Bersihkan pengaturan email sebelumnya untuk setiap pengiriman baru
                    $email->setTo($user['email']);
                    $email->setSubject('Pengingat: Tugas "' . esc($task['title']) . '" akan segera jatuh tempo!');
                    $email->setMessage('
                        <p>Halo ' . esc($user['username']) . ',</p>
                        <p>Ini adalah pengingat bahwa tugas Anda:</p>
                        <h3>' . esc($task['title']) . '</h3>
                        <p>akan jatuh tempo pada tanggal <strong>' . esc(date('d F Y', strtotime($task['due_date']))) . '</strong>.</p>
                        <p>Deskripsi Tugas: ' . nl2br(esc($task['description'])) . '</p>
                        <p>Prioritas: ' . esc(ucfirst($task['priority'])) . '</p>
                        <br>
                        <p>Jangan lupa untuk segera menyelesaikannya!</p>
                        <br>
                        <p>Terima kasih,</p>
                        <p>Tim RemindPlanner</p>
                    ');

                    // Set email menjadi format HTML
                    $email->setMailType('html');

                    if ($email->send()) {
                        log_message('info', 'Reminder email sent to ' . $user['email'] . ' for task ID: ' . $task['task_id']);
                    } else {
                        // Log pesan error jika pengiriman gagal
                        $error = $email->printDebugger(['headers']);
                        log_message('error', 'Failed to send reminder email to ' . $user['email'] . ' for task ID: ' . $task['task_id'] . '. Error: ' . $error);
                    }
                } else {
                    log_message('warning', 'User or user email not found for task ID: ' . $task['task_id']);
                }
            }
        } else {
            log_message('info', 'No upcoming tasks found for sending daily reminders.');
        }

        // Output ini berguna jika Anda menjalankan melalui browser atau CLI
        // Namun, jika di cron job, output ini biasanya dialihkan ke /dev/null
        echo "Proses pengiriman pengingat harian selesai.";
    }
}
