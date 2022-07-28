<?= $this->extend('layouts/app') ;?>

<?= $this->section('title') ?>
  Data Admin
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-8">
            <div class="text-right mb-4">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newAdmin">+ Admin</button>
            </div>
            <div class="card text-center">
              <div class="card-header">
                <h2 class="text-center">Data Admin</h2>
              </div>
              <div class="card-body">
                <table id="admin-table" class="table table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        foreach ($admins as $admin) {
                          ?>
                            <tr>
                              <td scope="row"><?= $no++ ?></td>
                              <td><?= $admin->nama ?></td>
                              <td class="row justify-content-around">
                                <button type="button" class="btn btn-warning" onclick="editModal('<?= $admin->admin_id ?>', '<?= $admin->nama ?>')">
                                  Edit
                                </button>
                                <a href="<?= base_url() . route_to('delete-admin', $admin->admin_id) ?>" onclick="return confirm('Yakin ingin menghapus Admin ini?')" class="btn btn-danger">
                                  Hapus
                                </a>
                              </td>
                            </tr>
                          <?php
                        }                      
                      ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
    
    <!-- Create Modal -->
    <div class="modal fade" id="newAdmin" tabindex="-1" role="dialog" aria-labelledby="newUser" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New User Admin</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form id="form-new-admin" action="<?= base_url() . route_to('create-admin') ?>" method="post">

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
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control <?php echo (service('validation')->hasError('nama')) ? 'is-invalid' : ''  ?>" name="nama" id="nama" value="<?= old('nama') ?>" aria-describedby="namaHelp" placeholder="Masukkan Nama Admin . . . ">
                <div class="row justify-content-end m-1">
                  <?php
                    if (service('validation')->hasError('nama')) {
                      ?>
                        <span class="text-danger" role="alert">
                            <small><?= service('validation')->getError('nama') ?></small>
                        </span>
                      <?php
                    }
                  ?>
                </div>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control <?php echo (service('validation')->hasError('username')) ? 'is-invalid' : ''  ?>" name="username" id="username" value="<?= old('username') ?>" aria-describedby="UsernameHelp" placeholder="Masukkan Username . . . ">
                <div class="row justify-content-between m-1">
                  <small id="UsernameHelp" class="form-text text-muted">Username tidak boleh memiliki spasi</small>
                  <?php
                    if (service('validation')->hasError('username')) {
                      ?>
                        <span class="text-danger" role="alert">
                            <small><?= service('validation')->getError('username') ?></small>
                        </span>
                      <?php
                    }
                  ?>
                </div>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control <?php echo (service('validation')->hasError('password')) ? 'is-invalid' : ''  ?>" name="password" id="password" value="<?= old('password') ?>" aria-describedby="passwordHelp" placeholder="Masukkan password . . . ">
                <div class="row justify-content-end m-1">
                  <?php
                    if (service('validation')->hasError('password')) {
                      ?>
                        <span class="text-danger" role="alert">
                            <small><?= service('validation')->getError('password') ?></small>
                        </span>
                      <?php
                    }
                  ?>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" form="form-new-admin" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editAdmin" tabindex="-1" role="dialog" aria-labelledby="newUser" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Admin</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form id="form-edit-admin" action="" method="post">

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
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control <?php echo (service('validation')->hasError('nama')) ? 'is-invalid' : ''  ?>" name="updateNama" id="edit-nama" aria-describedby="namaHelp" placeholder="Masukkan Nama Admin . . . ">
                <div class="row justify-content-end m-1">
                  <?php
                    if (service('validation')->hasError('nama')) {
                      ?>
                        <span class="text-danger" role="alert">
                            <small><?= service('validation')->getError('nama') ?></small>
                        </span>
                      <?php
                    }
                  ?>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" form="form-edit-admin" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
    
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
  $(function () {
    $("#admin-table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#admin-table-wrapper');
    // $('#product-table').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });
  });

  function editModal(admin_id, nama) {
    $('#editAdmin').modal('show')
    $('#edit-nama').val(nama)
    $('#form-edit-admin').attr('action', `<?= base_url() ?>/admin/${admin_id}`)
  }
</script>
<?= $this->endSection() ?>