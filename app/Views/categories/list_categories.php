<?= $this->extend('templates/dashboard/main') ?>

<?= $this->section('list_categories') ?>
<div class="container">
    <h2>Category List</h2>

    <a href="<?= base_url('categories/create') ?>" class="btn btn-success mb-3">Add New Category</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $index => $cat): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($cat['name']) ?></td>
                        <td><?= esc($cat['description']) ?></td>
                        <td>
                            <a href="<?= base_url('categories/edit/'.$cat['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= base_url('categories/delete/'.$cat['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr><td colspan="4">No categories found.</td></tr>
            <?php endif ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
