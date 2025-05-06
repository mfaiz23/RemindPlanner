<?= $this->extend ('templates/dashboard/main') ?>

<?= $this->section ('form_categories') ?>

<div class="container">
    <h2><?= isset($category) ? 'Edit' : 'Add' ?> Category</h2>

    <form action="<?= isset($category) ? base_url('categories/update/'.$category['id']) : base_url('categories/store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $category['name'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description"><?= $category['description'] ?? '' ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary"><?= isset($category) ? 'Update' : 'Create' ?></button>

        <?php if (isset($category)) : ?>
            <a href="<?= base_url('categories/delete/'.$category['id']) ?>" class="btn btn-danger" onclick="return confirm('Delete this category?')">Delete</a>
        <?php endif ?>
    </form>
</div>

<?= $this->endSection () ?>