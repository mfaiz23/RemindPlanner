<?= $this->extend('./templates/dashboard_admin/main') ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>List Tasks</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Task List
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
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
                                    <th><h6>ID</h6></th>
                                    <th><h6>User</h6></th>
                                    <th class="lead-info"><h6>Title</h6></th>
                                    <th class="lead-company"><h6>Description</h6></th>
                                    <th><h6>Due Date</h6></th>
                                    <th><h6>Status</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($tasks)): ?>
                                    <?php foreach ($tasks as $task): ?>
                                        <tr>
                                            <td><p><?= esc($task['id']) ?></p></td>
                                            <td><p><?= esc($task['user_name']) ?></p></td>
                                            <td><p><?= esc($task['title']) ?></p></td>
                                            <td><p><?= esc($task['description']) ?></p></td>
                                            <td><p><?= date('d M Y', strtotime($task['due_date'])) ?></p></td>
                                            <td>
                                                <span class="badge <?= $task['status'] === 'completed' ? 'bg-success' : ($task['status'] === 'in_progress' ? 'bg-warning' : 'bg-secondary') ?>">
                                                    <?= esc(ucfirst($task['status'])) ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <p>No tasks found.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

