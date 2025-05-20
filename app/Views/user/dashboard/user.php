<?= $this->extend('templates/dashboard_user/main') ?>

<?= $this->section ('content'); ?>

        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Dashboard</h2>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="#0">Dashboard</a>
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->
          <div class="row">
  <div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="icon-card mb-30">
      <div class="icon primary">
        <i class="lni lni-list"></i>
      </div>
      <div class="content">
        <h6 class="mb-10">Total Tasks</h6>
        <h3 class="text-bold mb-10"><?= $total_tasks ?></h3>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="icon-card mb-30">
      <div class="icon warning">
        <i class="lni lni-folder"></i>
      </div>
      <div class="content">
        <h6 class="mb-10">Total Categories</h6>
        <h3 class="text-bold mb-10"><?= $total_categories ?></h3>
      </div>
    </div>
  </div>
</div>

          <!-- End Row -->
          
          <!-- End Row -->
        </div>
        <!-- end container -->
<?= $this->endSection (); ?>