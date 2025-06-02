<!-- app/Views/auth/forgot_password.php -->
<?= $this->extend('templates/auth/main') ?>

<?= $this->section('content') ?>
<section class="signin-section">
    <div class="row g-0 auth-row">
        <div class="col-lg-6">
            <div class="auth-cover-wrapper bg-primary-100">
                <div class="auth-cover">
                    <div class="title text-center">
                        <h1 class="text-primary mb-10">Forgot Password</h1>
                        <p class="text-medium">
                            Enter your email to receive a password reset link.
                        </p>
                    </div>
                    <div class="cover-image">
                        <img src="<?= base_url('assets/images/auth/signin-image.svg') ?>" alt="" />
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="signin-wrapper">
                <div class="form-wrapper">
                    <h6 class="mb-15">Reset Password</h6>

                    <!-- Display error if there is one -->
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('/forgot_password') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder="Enter your email" required />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                        Send OTP
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="singin-option pt-40">
                        <p class="text-sm text-medium text-center text-gray">
                            Remember your password? 
                            <a href="<?= base_url('login') ?>">Sign In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->include('templates/footer') ?>
