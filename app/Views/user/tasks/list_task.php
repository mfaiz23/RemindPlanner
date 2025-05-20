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
    <div class="status-wrapper" id="status-wrapper-<?= $task['id'] ?>">
        <!-- Badge -->
        <?php
            $status = $task['status'];
            $badgeClass = [
                'pending' => 'bg-warning',
                'in_progress' => 'bg-info',
                'completed' => 'bg-success',
                'cancelled' => 'bg-danger',
            ][$status];
            $statusText = [
                'pending' => 'Pending',
                'in_progress' => 'In Progress',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ][$status];
        ?>
        <span class="badge <?= $badgeClass ?>" onclick="toggleEdit(<?= $task['id'] ?>)" style="cursor: pointer;">
            <?= $statusText ?> <i class="lni lni-pencil-alt"></i>
        </span>

        <!-- Hidden Select -->
        <select class="form-select form-select-sm mt-2 d-none"
        id="select-status-<?= $task['id'] ?>"
        style="width: auto; min-width: 140px; display: inline-block; padding: 2px 6px; font-size: 0.8rem;"
        onchange="updateStatus(<?= $task['id'] ?>, this.value)">
    <option value="pending" <?= $status == 'pending' ? 'selected' : '' ?>>Pending</option>
    <option value="in_progress" <?= $status == 'in_progress' ? 'selected' : '' ?>>In Progress</option>
    <option value="completed" <?= $status == 'completed' ? 'selected' : '' ?>>Completed</option>
    <option value="cancelled" <?= $status == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
</select>

    </div>
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

<script>
function updateStatus(taskId, status) {
    fetch(`/tasks/update-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ id: taskId, status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Status updated');
            // reload badge secara lokal tanpa reload halaman
            const wrapper = document.getElementById('status-wrapper-' + taskId);
            const select = document.getElementById('select-status-' + taskId);
            const selectedText = select.options[select.selectedIndex].text;
            const statusClass = {
                pending: 'bg-warning',
                in_progress: 'bg-info',
                completed: 'bg-success',
                cancelled: 'bg-danger'
            }[status];

            wrapper.innerHTML = `
    <span class="badge ${statusClass}" onclick="toggleEdit(${taskId})" style="cursor: pointer;">
        ${selectedText} <i class="lni lni-pencil-alt"></i>
    </span>
    <select class="form-select form-select-sm mt-2 d-none fade-in"
            id="select-status-${taskId}"
            style="width: auto; min-width: 140px; display: inline-block; padding: 2px 6px; font-size: 0.8rem;"
            onchange="updateStatus(${taskId}, this.value)">
        <option value="pending" ${status === 'pending' ? 'selected' : ''}>Pending</option>
        <option value="in_progress" ${status === 'in_progress' ? 'selected' : ''}>In Progress</option>
        <option value="completed" ${status === 'completed' ? 'selected' : ''}>Completed</option>
        <option value="cancelled" ${status === 'cancelled' ? 'selected' : ''}>Cancelled</option>
    </select>
`;

        } else {
            alert('Gagal update status');
        }
    })
    .catch(err => {
        console.error('Error:', err);
    });
}

function toggleEdit(taskId) {
    const selectEl = document.getElementById('select-status-' + taskId);
    if (selectEl.classList.contains('d-none')) {
        selectEl.classList.remove('d-none');
        selectEl.classList.add('fade-in');
        selectEl.focus();
    } else {
        selectEl.classList.add('d-none');
        selectEl.classList.remove('fade-in');
    }
}


</script>


<?= $this->endSection() ?>
