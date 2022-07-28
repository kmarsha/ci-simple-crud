<?= $this->extend('layouts/app') ;?>

<?= $this->section('title') ?>
  Data User
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card text-center">
              <div class="card-header">
                <h2 class="text-center">Data User Admin</h2>
              </div>
              <div class="card-body">
                <table class="table table-striped user-table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Username</th>
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
                              <td><?= $admin->username ?></td>
                              <td class="row justify-content-around">
                                <a href="<?= base_url() . route_to('edit-user', $admin->user_id) ?>" class="btn btn-warning">
                                  Edit
                                </a>
                                <a href="<?= base_url() . route_to('delete-user', $admin->user_id) ?>" onclick="return confirm('Yakin ingin menghapus User ini?')" class="btn btn-danger">
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
        <div class="row">
          <div class="col-12">
            <div class="card text-center">
              <div class="card-header">
                <h2 class="text-center">Data User Karyawan</h2>
              </div>
              <div class="card-body">
                <table class="table table-striped user-table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        foreach ($employees as $employee) {
                          ?>
                            <tr>
                              <td scope="row"><?= $no++ ?></td>
                              <td><?= $employee->nama_karyawan ?></td>
                              <td><?= $employee->username ?></td>
                              <td class="row justify-content-around">
                                <a href="<?= base_url() . route_to('edit-user', $employee->user_id) ?>" class="btn btn-warning">
                                  Edit
                                </a>
                                <a href="" onclick="return confirm('Yakin ingin menghapus User ini?')" class="btn btn-danger">
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
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
  $(function () {
    $(".user-table").DataTable({
      pageLength: 2, 
      // lengthMenu: [[2,4,8, -1], [2,4,8, 'Users']] ,
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('.user-table-wrapper');
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
</script>
<?= $this->endSection() ?>