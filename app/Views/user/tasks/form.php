<?= $this->extend ('templates/dashboard_user/main') ?>

<?= $this->section ('content') ?>

<div class="container">

    <form action="<?= isset($tasks) ? base_url('tasks/update/'.$tasks['id']) : base_url('tasks/store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="card-style mt-20 mb-30">
                  <h6 class ="mb-25"><?= isset($tasks) ? 'Edit' : 'Add' ?> Task</h6>
                  <div class="input-style-1">
                    <label>Task Name</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?= $tasks['title'] ?? '' ?>" required>
                  </div>

                  <div class="input-style-1">
                    <label>Description</label>
                    <textarea class="form-control" name="description" id="description" rows="5"><?= $tasks['description'] ?? '' ?></textarea>
                  </div>
  <div class="input-style-1">
                <label>Due Date</label>
                <input type="date" class="form-control" name="due_date" id="due_date" value="<?= $tasks['due_date'] ?? '' ?>" min="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="input-style-1">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="pending" <?= (isset($tasks['status']) && $tasks['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                    <option value="in_progress" <?= (isset($tasks['status']) && $tasks['status'] == 'in_progress') ? 'selected' : '' ?>>In Progress</option>
                    <option value="completed" <?= (isset($tasks['status']) && $tasks['status'] == 'completed') ? 'selected' : '' ?>>Completed</option>
                    <option value="cancelled" <?= (isset($tasks['status']) && $tasks['status'] == 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
                        <div class="input-style-1">
                <label>Category</label>
                <select name="c_id" class="form-control" >
                    <option value="">No Category</option>
                    <?php foreach($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= (isset($tasks['c_id']) && $tasks['c_id'] == $cat['id']) ? 'selected' : '' ?>>
                            <?= $cat['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

        <button type="submit" class="main-btn primary-btn rounded-full btn-hover"><a ><?= isset($tasks) ? 'Update' : 'Create' ?></a></button>
        <a href="<?= base_url('user/tasks') ?>" class="main-btn danger-btn-outline rounded-full btn-hover ml-10">Cancel</a>

    </form>
</div>

<?= $this->endSection () ?>