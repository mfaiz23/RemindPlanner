<?= $this->extend('templates/dashboard_user/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>Edit Profile</h2>
                </div>
            </div>
            <!-- end col -->
            <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('user/dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Profile
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <div class="form-layout-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <h6 class="mb-25">Profile Information</h6>

                    <!-- Display success/error messages -->
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

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('user/profile/update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Current Profile Picture</label>
                                    <div class="profile-image-preview mb-3">
                                        <?php if (!empty($user['profile_image'])): ?>
                                            <img src="<?= base_url('writable/uploads/profile/' . $user['profile_image']) ?>" 
                                                 alt="Profile Image" 
                                                 style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                                        <?php else: ?>
                                            <img src="<?= base_url('assets/images/profile/profile-image.png') ?>" 
                                                 alt="Default Profile" 
                                                 style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Upload New Profile Picture</label>
                                    <input type="file" name="profile_image" accept="image/*" class="form-control">
                                    <small class="text-muted">Maximum file size: 2MB. Supported formats: JPG, PNG, GIF</small>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Full Name</label>
                                    <input type="text" name="name" value="<?= old('name', $user['name']) ?>" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Email Address</label>
                                    <input type="email" value="<?= $user['email'] ?>" disabled>
                                    <small class="text-muted">Email cannot be changed</small>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="my-4">
                                <h6 class="mb-25">Change Password (Optional)</h6>
                                <small class="text-muted mb-3 d-block">Leave password fields empty if you don't want to change your password</small>
                            </div>

                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Current Password</label>
                                    <input type="password" name="current_password" placeholder="Enter current password">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>New Password</label>
                                    <input type="password" name="new_password" placeholder="Enter new password">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Confirm New Password</label>
                                    <input type="password" name="confirm_password" placeholder="Confirm new password">
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="main-btn primary-btn btn-hover">
                                    Update Profile
                                </button>
                                <a href="<?= base_url('user/dashboard') ?>" class="main-btn deactive-btn btn-hover ml-10">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Preview image before upload
document.querySelector('input[name="profile_image"]').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.querySelector('.profile-image-preview img');
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?= $this->endSection() ?>
