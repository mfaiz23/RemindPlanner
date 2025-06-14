<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\CategoryModel;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class TasksController extends Controller
{
    use ResponseTrait;
    protected $taskModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
    $tasks = $this->taskModel
        ->select('tasks.*, categories.name as category_name')
        ->join('categories', 'categories.id = tasks.c_id', 'left')
        ->where('tasks.user_id', $userId)
        ->findAll();

    return view('user/tasks/list_task', ['tasks' => $tasks]);
    }
    public function updateStatus()
{
    if ($this->request->isAJAX()) {
        $data = $this->request->getJSON();

        $taskModel = new \App\Models\TaskModel();
        $updated = $taskModel->update($data->id, [
            'status' => $data->status
        ]);

        if ($updated) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Invalid request']);
}

    public function create()
    {
        $userId = session()->get('user_id');
        $data['categories'] = $this->categoryModel->where('user_id', $userId)->findAll();

        return view('user/tasks/form', $data);
    }

    public function store()
    {
        $userId = session()->get('user_id');
        $c_id = $this->request->getPost('c_id');

        if (!empty($c_id)) {
            // Pastikan category itu milik user yang login
            $category = $this->categoryModel->where('id', $c_id)->where('user_id', $userId)->first();
            if (!$category) {
                return redirect()->back()->with('error', 'Category invalid or not yours');
            }
        } else {
            $c_id = null;
        }

        $status = $this->request->getPost('status');
        if (empty($status)) {
            $status = 'pending';
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'due_date'    => $this->request->getPost('due_date'),
            'status'      => $status,
            'c_id'        => $c_id,
            'user_id'     => $userId,
        ];

        $this->taskModel->insert($data);
        return redirect()->to(base_url('user/tasks'))->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $userId = session()->get('user_id');
        $task = $this->taskModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$task) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Task not found or not yours');
        }

        $data['tasks'] = $task;
        $data['categories'] = $this->categoryModel->where('user_id', $userId)->findAll();

        return view('user/tasks/form', $data);
    }

    public function update($id)
    {
        $userId = session()->get('user_id');
        $task = $this->taskModel->where('id', $id)->where('user_id', $userId)->first();
        $due_date = $this->request->getPost('due_date');

        if (!$task) {
            return redirect()->back()->with('error', 'Task not found or not yours');
        }

        $c_id = $this->request->getPost('c_id');
        if (!empty($c_id)) {
            $category = $this->categoryModel->where('id', $c_id)->where('user_id', $userId)->first();
            if (!$category) {
                return redirect()->back()->with('error', 'Category invalid or not yours');
            }
        } else {
            $c_id = null;
        }
        if ($due_date && strtotime($due_date) < strtotime(date('Y-m-d'))) {
            return redirect()->back()->withInput()->with('error', 'Due date cannot be in the past.');
        }

        $status = $this->request->getPost('status');
        if (empty($status)) {
            $status = $task['status'];
        }

        $this->taskModel->update($id, [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'due_date'    => $due_date,
            'status'      => $status,
            'c_id'        => $c_id,
        ]);

        return redirect()->to(base_url('user/tasks'))->with('success', 'Task updated successfully.');
    }

    public function delete($id)
    {
        $userId = session()->get('user_id');
        $task = $this->taskModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$task) {
            return redirect()->back()->with('error', 'Task not found or not yours');
        }

        $this->taskModel->delete($id);
        return redirect()->to(base_url('user/tasks'))->with('success', 'Task deleted successfully.');
    }
}
