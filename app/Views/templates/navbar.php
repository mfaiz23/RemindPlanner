<main class="main-wrapper">
<header class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
              <div class="header-left d-flex align-items-center">
                <div class="menu-toggle-btn mr-15">
                  <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-chevron-left me-2"></i> Menu
                  </button>
                </div>
                <h3>Remind Planner</h3>
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
              <div class="header-right">
                <!-- notification start -->
               
                <!-- notification end -->
                <!-- message start -->
               
                <!-- message end -->
                <!-- profile start -->
                <div class="profile-box ml-15">
                  <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-info">
                      <?php if (session()->get('logged_in')): ?>
                      <div class="info">
                        <div class="image">
                          <img src="/assets/images/profile/profile-image.png" alt="" />
                        </div>
                      <div>
                          <h6 class="fw-500"><?= esc(session()->get('name')) ?></h6>
                          <p><?= esc(session()->get('email')) ?></p>
                    </div>
                      </div>
                      <?php else: ?>
  <a class="btn-getstarted" href="/login">Login</a>
                      
                      <?php endif; ?>
                    </div>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                    <li>
                      <a href="<?= base_url('/logout') ?>"> <i class="lni lni-exit"></i> Sign Out </a>
                    </li>
                    </ul>
                  </ul>
                </div>
                <!-- profile end -->
              </div>
            </div>
          </div>
        </div>
      </header>