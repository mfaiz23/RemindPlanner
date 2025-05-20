<?= $this->extend('templates/dashboard_user/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>List Tasks
                        
                    </h2>
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#0">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List Task</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div align="right">
        <a href="<?= base_url('user/tasks/create') ?>" class="main-btn primary-btn btn-hover p-2 mb-3">
                            <i class="lni lni-plus mr-5"></i>Add New Task
                        </a>
         </div>
    </div>

    <div class="tables-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="table-wrapper table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><h6>No</h6></th>
                                    <th><h6>Task Title</h6></th>
                                    <th><h6>Description</h6></th>
                                    <th><h6>Due Date</h6></th>
                                    <th><h6>Status</h6></th>
                                    <th><h6>Category</h6></th>
                                    <th><h6>Action</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($tasks)): ?>
                                    <?php foreach ($tasks as $index => $task): ?>
                                        <tr>
                                            <td><p><?= $index + 1 ?></p></td>
                                            <td><p><?= esc($task['title']) ?></p></td>
                                            <td><p><?= esc($task['description']) ?></p></td>
                                            <td><p><?= esc($task['due_date']) ?></p></td>
                                            <td>
                                                <?php if ($task['status'] == 'pending'): ?>
                                                    <span class="badge bg-warning">Pending</span>
                                                <?php elseif ($task['status'] == 'in_progress'): ?>
                                                    <span class="badge bg-info">In Progress</span>
                                                <?php elseif ($task['status'] == 'completed'): ?>
                                                    <span class="badge bg-success">Completed</span>
                                                <?php elseif ($task['status'] == 'cancelled'): ?>
                                                    <span class="badge bg-danger">Cancelled</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><p><?= esc($task['category_name'] ?? 'Not in Category') ?></p></td>
                                            <td>
                                                <a href="<?= base_url('tasks/edit/'.$task['id']) ?>"><i class="lni lni-pencil-alt" style="font-size: 20px;"></i></a>
                                                <a class="text-danger ml-10" href="<?= base_url('tasks/delete/'.$task['id']) ?>" onclick="return confirm('Are you sure to delete?')"><i class="lni lni-trash-can" style="font-size: 20px;"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <tr><td colspan="7">No tasks found.</td></tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
