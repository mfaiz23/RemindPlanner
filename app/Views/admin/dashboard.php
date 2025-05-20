<?= $this->extend('templates/dashboard_admin/main') ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>Admin Dashboard</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#0">Admin Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon purple">
                    <i class="lni lni-users"></i>
                </div>
                <div class="content">
                    <h6 class="mb-10">Total Users</h6>
                    <h3 class="text-bold mb-10"><?= $total_users ?></h3>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="icon-card mb-30">
        <div class="icon warning">
            <i class="lni lni-checkmark-circle"></i>
        </div>
        <div class="content">
            <h6 class="mb-10">Total Tasks</h6>
            <h3 class="text-bold mb-10"><?= $total_tasks_user ?></h3>
        </div>
    </div>
</div>
        <!-- Add more admin-specific cards as needed -->
    </div>
    
    <!-- Add admin-specific content sections here -->
</div>

<?= $this->endSection(); ?>