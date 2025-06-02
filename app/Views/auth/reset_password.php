<?= $this->extend('templates/auth/main') ?>

<?= $this->section('content') ?>
<section class="signin-section">
    <div class="row g-0 auth-row">
        <div class="col-lg-6">
            <div class="auth-cover-wrapper bg-primary-100">
                <div class="auth-cover">
                    <div class="title text-center">
                        <h1 class="text-primary mb-10">Reset Password</h1>
                        <p class="text-medium">
                            Masukkan password baru Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="signin-wrapper">
                <div class="form-wrapper">
                    <h6 class="mb-15">Reset Password</h6>

                    <!-- Tampilkan error jika ada -->
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('forgot_password/update_password') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
<div class="col-12">
    <div class="input-style-1">
        <label>Password Baru</label>
        <input type="password" name="password" placeholder="Masukkan password baru" required minlength="6" />
        <small class="text-muted">Password minimal 6 karakter.</small>
    </div>
</div>


                            <div class="col-12">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->include('templates/footer') ?>
