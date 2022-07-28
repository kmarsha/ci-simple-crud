<?= $this->extend('layouts/app') ;?>

<?= $this->section('title') ?>
  Data Karyawan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="text-right mb-4">
              <a href="<?= base_url() . route_to('new-employee') ?>" class="btn btn-success">+ Karyawan</a>
            </div>
            <div class="card text-center">
              <div class="card-header">
                <h2 class="text-center">Data Vaksin Karyawan</h2>
              </div>
              <div class="card-body">
                <table id="karyawan-table" class="table table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Karyawan</th>
                      <th>Usia</th>
                      <th>Status Vaksin 1</th>
                      <th>Status Vaksin 2</th>
                      <th>Status Vaksin 3</th>
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
                              <td><?= $employee->usia ?></td>
                              <td><?= $employee->status_vaksin_1 ?></td>
                              <td><?= $employee->status_vaksin_2 ?></td>
                              <td><?= $employee->status_vaksin_3 ?></td>
                              <td class="row justify-content-between">
                                <a href="<?= base_url() . route_to('edit-employee', $employee->id_karyawan) ?>" class="btn btn-warning">
                                  Edit
                                </a>
                                <a href="<?= base_url() . route_to('delete-employee', $employee->id_karyawan) ?>" onclick="return confirm('Yakin ingin menghapus Karyawan ini?')" class="btn btn-danger">
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
    $("#karyawan-table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#karyawan-table-wrapper');
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