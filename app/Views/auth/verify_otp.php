<?= $this->extend('templates/auth/main') ?>

<?= $this->section('content') ?>
<section class="signin-section">
    <div class="row g-0 auth-row">
        <div class="col-lg-6">
            <div class="auth-cover-wrapper bg-primary-100">
                <div class="auth-cover">
                    <div class="title text-center">
                        <h1 class="text-primary mb-10">Verifikasi OTP</h1>
                        <p class="text-medium">
                            Masukkan OTP yang telah dikirim ke email Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="signin-wrapper">
                <div class="form-wrapper">
                    <h6 class="mb-15">Verifikasi OTP</h6>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('/forgot_password/verify_otp') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label>OTP</label>
                                    <input type="text" name="otp" placeholder="Masukkan OTP" value="<?= old('otp') ?>" required />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                        Verifikasi OTP
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="singin-option pt-40">
                        <p class="text-sm text-medium text-center text-gray">
                            Belum menerima OTP atau OTP sudah kedaluwarsa?
                            <a href="<?= base_url('forgot_password/resend_otp') ?>">Kirim ulang OTP</a>
                        </p>
                        <p class="text-sm text-medium text-center text-gray pt-2">
                            Salah memasukkan email? <a href="<?= base_url('forgot_password') ?>">Kembali</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
<?php // <?= $this->include('templates/footer') ?> // Footer biasanya diinclude di main template ?>