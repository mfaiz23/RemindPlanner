<?= $this->extend('templates/auth/main') ?>

<?= $this->section('login') ?>
<section class="signin-section">
        <div class="row g-0 auth-row">
            <div class="col-lg-6">
                <div class="auth-cover-wrapper bg-primary-100">
                    <div class="auth-cover">
                        <div class="title text-center">
                            <h1 class="text-primary mb-10">Welcome Back</h1>
                            <p class="text-medium">
                                Sign in to your Existing account to continue
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
                        <h6 class="mb-15">Sign In Form</h6>

                        <!-- Tampilkan error jika ada -->
                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('auth/login') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Email</label>
                                        <input type="email" name="email" placeholder="Email" required />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Password</label>
                                        <input type="password" name="password" placeholder="Password" required />
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-md-6">
                                    <div class="form-check checkbox-style mb-30">
                                        <input class="form-check-input" type="checkbox" name="remember" id="checkbox-remember" />
                                        <label class="form-check-label" for="checkbox-remember">
                                            Remember me next time
                                        </label>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-md-6">
                                    <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                                        <a href="<?= base_url('auth/forgot-password') ?>" class="hover-underline">
                                            Forgot Password?
                                        </a>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="button-group d-flex justify-content-center flex-wrap">
                                        <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                            Sign In
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="singin-option pt-40">
                            <p class="text-sm text-medium text-center text-gray">
                                Easy Sign In With
                            </p>
                            <div class="button-group pt-40 pb-40 d-flex justify-content-center flex-wrap">
                                <!-- Gunakan link dari controller -->
                                <a href="<?= esc($googleButton) ?>" class="main-btn danger-btn-outline m-2">
                                <i class="lni lni-google mr-10"></i>
                                    Google
                                </a>
                            </div>
                            <p class="text-sm text-medium text-dark text-center">
                                Don't have any account yet?
                                <a href="<?= base_url('auth/register') ?>">Create an account</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->include('templates/footer') ?>
