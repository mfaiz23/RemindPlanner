<?= $this->extend('templates/auth/main') ?>

<?= $this->section('content') ?>
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
        
          <!-- ========== title-wrapper end ========== -->

          <div class="row g-0 auth-row">
            <div class="col-lg-6">
              <div class="auth-cover-wrapper bg-primary-100">
                <div class="auth-cover">
                  <div class="title text-center">
                    <h1 class="text-primary mb-10">Get Started</h1>
                    <p class="text-medium">
                      Start creating the best possible user experience
                      <br class="d-sm-block" />
                      for you customers.
                    </p>
                  </div>
                  <div class="cover-image">
                    <img src="assets/images/auth/signin-image.svg" alt="" />
                  </div>
                  <div class="shape-image">
                    <img src="assets/images/auth/shape.svg" alt="" />
                  </div>
                </div>
              </div>
            </div>
            <!-- end col -->
            <div class="col-lg-6">
              <div class="signup-wrapper">
                <div class="form-wrapper">
                  <h6 class="mb-15">Sign Up Form</h6>
                  <p class="text-sm mb-25">
                    Start creating the best possible user experience for you
                    customers.
                  </p>
                  <form action="<?= base_url('register/store') ?>" method="post">
  <div class="row">
    <div class="col-12">
      <div class="input-style-1">
        <label>Name</label>
        <input type="text" name="username" placeholder="Name" required />
      </div>
    </div>
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
    <div class="col-12">
      <div class="form-check checkbox-style mb-30">
        <input class="form-check-input" type="checkbox" value="1" id="checkbox-not-robot" required />
        <label class="form-check-label" for="checkbox-not-robot">
          I'm not robot
        </label>
      </div>
    </div>
    <div class="col-12">
      <div class="button-group d-flex justify-content-center flex-wrap">
        <button class="main-btn primary-btn btn-hover w-100 text-center">
          Sign Up
        </button>
      </div>
    </div>
  </div>
</form>

                  <?php if (isset($validation)): ?>
                    <div>
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>
                  <div class="singup-option pt-40">
                    <p class="text-sm text-medium text-center text-gray">
                      Easy Sign Up With
                    </p>
                    <div class="button-group pt-40 pb-40 d-flex justify-content-center flex-wrap">
                      <button class="main-btn danger-btn-outline m-2">
                        <i class="lni lni-google mr-10"></i>
                        Google
                      </button>
                    </div>
                    <p class="text-sm text-medium text-dark text-center">
                      Already have an account? <a href="/login">Sign In</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>


<?= $this->endSection() ?>