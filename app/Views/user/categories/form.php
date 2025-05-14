<?= $this->extend ('templates/dashboard_user/main') ?>

<?= $this->section ('content') ?>

<div class="container">

    <form action="<?= isset($category) ? base_url('categories/update/'.$category['id']) : base_url('categories/store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="card-style mt-20 mb-30">
                  <h6 class ="mb-25"><?= isset($category) ? 'Edit' : 'Add' ?> Category</h6>
                  <div class="input-style-1">
                    <label>Category Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= $category['name'] ?? '' ?>" required>
                  </div>

                  <div class="input-style-1">
                    <label>Description</label>
                    <textarea class="form-control" name="description" id="description" rows="5"><?= $category['description'] ?? '' ?></textarea>
                  </div>

        <button type="submit" class="main-btn primary-btn rounded-full btn-hover"><a ><?= isset($category) ? 'Update' : 'Create' ?></a></button>
        <a href="<?= base_url('user/categories') ?>" class="main-btn danger-btn-outline rounded-full btn-hover ml-10">Cancel</a>

    </form>
</div>

<?= $this->endSection () ?>