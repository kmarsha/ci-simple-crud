<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
  New Karyawan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <div class="card">
            <div class="card-header">
              <h2 class="text-center">Upload Foto</h2>
            </div>
            <div class="card-body">
              <form id="form-photo" action="<?= base_url() . route_to('upload-photo') ?>" name="photo" id="photo" method="post" enctype="multipart/form-data">

              <?php
                if (session()->has('error')) {
                  ?>
                  <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                  </div>
                  <?php
                }
              ?>

                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                  </div>
                </div>
                  <div class="row justify-content-end m-1">
                    <?php
                      if (service('validation')->hasError('photo')) {
                        ?>
                          <span class="text-danger" role="alert">
                              <small><?= service('validation')->getError('photo') ?></small>
                          </span>
                        <?php
                      }
                    ?>
                  </div>
              </form>
            </div>
            <div class="card-footer">
              <div class="text-right">
                <button class="btn btn-success" type="submit" form="form-photo">Upload</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?= $this->endSection() ?>
