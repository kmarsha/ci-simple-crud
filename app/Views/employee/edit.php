<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
  Edit Karyawan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <div class="card">
            <div class="card-header">
              <h2 class="text-center">Ubah Data Karyawan</h2>
            </div>
            <div class="card-body">
              <form id="form-karyawan" action="<?= base_url() . route_to('update-employee', $employee->id_karyawan) ?>" name="karyawan" id="karyawan" method="post">	

                <?php
                  if (session()->has('error')) {
                    ?>
                    <div class="alert alert-danger">
                      <?= session()->getFlashdata('error') ?>
                    </div>
                    <?php
                  }
                ?>

                <div class="mb-3">
                  <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                  <input type="text" class="form-control <?php echo (service('validation')->hasError('nama_karyawan')) ? 'is-invalid' : ''  ?>" name="nama_karyawan" id="nama_karyawan" value="<?= $employee->nama_karyawan ?>" aria-describedby="nama_karyawanHelp" placeholder="Masukkan Nama Karyawan . . . ">
                  <div class="row justify-content-end m-1">
                    <?php
                      if (service('validation')->hasError('nama_karyawan')) {
                        ?>
                          <span class="text-danger" role="alert">
                              <small><?= service('validation')->getError('nama_karyawan') ?></small>
                          </span>
                        <?php
                      }
                    ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="usia" class="form-label">Usia</label>
                  <input type="number" min="1" class="form-control <?php echo (service('validation')->hasError('usia')) ? 'is-invalid' : ''  ?>" name="usia" id="usia" value="<?= $employee->usia ?>" aria-describedby="usiaHelp" placeholder="Masukkan Usia . . . ">
                  <div class="row justify-content-between m-1">
                    <small id="usiaHelp" class="form-text text-muted">Cukup masukkan angka saja</small>
                    <?php
                      if (service('validation')->hasError('usia')) {
                        ?>
                          <span class="text-danger" role="alert">
                              <small><?= service('validation')->getError('usia') ?></small>
                          </span>
                        <?php
                      }
                    ?>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="vaksin1" class="form-label">Status Vaksin 1</label>
                  <select class="form-control" name="vaksin1" id="vaksin1">
                    <option value="<?= $employee->status_vaksin_1 ?>">---Pilih Status Vaksin---</option>
                    <option value="belum" selected>Belum Vaksin</option>
                    <option value="sudah">Sudah Vaksin</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="vaksin2" class="form-label">Status Vaksin 2</label>
                  <select class="form-control" name="vaksin2" id="vaksin2">
                    <option value="<?= $employee->status_vaksin_2 ?>">---Pilih Status Vaksin---</option>
                    <option value="belum" selected>Belum Vaksin</option>
                    <option value="sudah">Sudah Vaksin</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="vaksin3" class="form-label">Status Vaksin 3</label>
                  <select class="form-control" name="vaksin3" id="vaksin3">
                    <option value="<?= $employee->status_vaksin_3 ?>">---Pilih Status Vaksin---</option>
                    <option value="belum" selected>Belum Vaksin</option>
                    <option value="sudah">Sudah Vaksin</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="card-footer row justify-content-end">
              <button class="btn btn-primary" type="submit" id="send_form" form="form-karyawan">Ubah</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?= $this->endSection() ?>