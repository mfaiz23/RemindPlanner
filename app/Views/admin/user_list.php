<?= $this->extend('./templates/dashboard_admin/main') ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>List User</h2>
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
                                User List
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
                    <!-- Flash Messages -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="table-wrapper table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><h6>ID</h6></th>
                                    <th class="lead-info"><h6>Name</h6></th>
                                    <th class="lead-company"><h6>Email</h6></th>
                                    <th><h6>Role</h6></th>
                                    <th><h6>Created At</h6></th>
                                    <th><h6>Action</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td><p><?= esc($user['id']) ?></p></td>
                                            <td><p><?= esc($user['name']) ?></p></td>
                                            <td><p><?= esc($user['email']) ?></p></td>
                                            <td>
                                                <span class="badge <?= $user['role'] === 'admin' ? 'bg-primary' : 'bg-secondary' ?>">
                                                    <?= esc(ucfirst($user['role'])) ?>
                                                </span>
                                            </td>
                                            <td><p><?= date('d M Y', strtotime($user['created_at'])) ?></p></td>
                                            <td>
                                                
                                                <!-- Delete Button -->
                                                <?php if ($user['id'] != session()->get('user_id')): ?>
                                                    <form action="<?= base_url('admin/users/delete/' . $user['id']) ?>" 
                                                          method="post" 
                                                          style="display:inline;" 
                                                          onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" 
                                                                class="btn btn-link text-danger p-0 ml-10" 
                                                                style="font-size: 20px; border: none; background: none;"
                                                                title="Delete User">
                                                            <i class="lni lni-trash-can"></i>
                                                        </button>
                                                    </form>
                                                <?php else: ?>
                                                    <span class="text-muted ml-10" title="Cannot delete your own account">
                                                        <i class="lni lni-trash-can" style="font-size: 20px;"></i>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <p>No users found.</p>
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
