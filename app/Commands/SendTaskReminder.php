<?php namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\TaskModel;
use App\Libraries\Email;

class SendTaskReminder extends BaseCommand
{
    protected $group = 'custom';
    protected $name = 'task:send-reminder';
    protected $description = 'Send task reminders to users before due date';

    public function run(array $params)
    {
        $taskModel = new TaskModel();
        $emailLib = new Email();

    $tomorrow = date('Y-m-d', strtotime('+1 day'));

    // Ambil task dengan info user
    $tasks = $taskModel->getTasksWithUserInfo($tomorrow);

    CLI::write("Task to remind (H-1): " . count($tasks), 'yellow');

    foreach ($tasks as $task) {
        $to = $task['user_email'];
        $subject = "Reminder: Task \"{$task['title']}\" is due tomorrow!";
        $message = "Hi {$task['user_name']},\n\nYour task \"{$task['title']}\" is due on {$task['due_date']}.\nDon't forget to complete it!\n\nThanks!";

        try {
            $emailLib->send($to, $subject, $message);
            CLI::write("Reminder sent to: $to", 'green');

            // Update task
            $taskModel->update($task['id'], ['reminder_sent' => 1]);
        } catch (\Exception $e) {
            CLI::error("Failed to send to $to: " . $e->getMessage());
        }
    }

}
}
