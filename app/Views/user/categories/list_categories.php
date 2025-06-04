<?= $this->extend('templates/dashboard_user/main') ?>

<?= $this->section('content') ?>
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>List Categories     <a href="<?= base_url('categories/create') ?>" class="main-btn primary-btn btn-hover p-2 ml-10"><i class="lni lni-plus mr-5"></i>Add New Category</a></h2>
                  
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
                      <li class="breadcrumb-item active" aria-current="page">
                        Categories 
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>

          <div class="tables-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-style mb-30">
                  <div class="table-wrapper table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                        <th>
                            <h6>No</h6>
                          </th>
                          <th class="lead-info">
                            <h6>Name</h6>
                          </th>
                          <th class="lead-company">
                            <h6>Description</h6>
                          </th>
                          <th>
                            <h6>Action</h6>
                          </th>

                        
                        </tr>

        <tbody>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $index => $cat): ?>
                    <tr>
                        <td><p><?= $index + 1 ?></p></td>
                        <td><p><?= esc($cat['name']) ?></p></td>
                        <td><p><?= esc($cat['description']) ?></p></td>
                        <td>
                         <a href="<?= base_url('categories/edit/'.$cat['id']) ?>" ><i class="lni lni-pencil-alt" style="font-size: 20px;"></i></a>
                            <a class="text-danger ml-10" href="<?= base_url('categories/delete/'.$cat['id']) ?>" onclick="return confirm('Are you sure to delete?')"><i class="lni lni-trash-can" style="font-size: 20px;"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else: ?>
                <tr><td colspan="4">No categories found.</td></tr>
            <?php endif ?>
        </tbody>
    </table>
    </div>
            </div>
            </div>
            </div>
            </div>
            </div>

<?= $this->endSection() ?>
