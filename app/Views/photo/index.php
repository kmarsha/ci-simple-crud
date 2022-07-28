<?= $this->extend('layouts/app') ;?>

<?= $this->section('title') ?>
  Photos
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="text-right mb-4">
              <a href="<?= base_url() . route_to('new-photo') ?>" class="btn btn-success">+ Photo</a>
            </div>
            <div class="card text-center">
              <div class="card-header">
                <h2 class="text-center">Photos</h2>
              </div>
              <div class="card-body">
                <table id="photo-table" class="table table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Type</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        foreach ($photos as $photo) {
                          ?>
                            <tr>
                              <td scope="row"><?= $no++ ?></td>
                              <td>
                                <img src="<?= base_url() ?>/img/uploads/<?= $photo->name ?>" alt="Photo <?= $photo->name ?>" width="150">
                              </td>
                              <td><?= $photo->name ?></td>
                              <td><?= $photo->type ?></td>
                              <td class="row justify-content-around">
                                <a href="<?= base_url() . route_to('download-photo', $photo->id) ?>" class="btn btn-warning">
                                  Download
                                </a>
                                <a href="<?= base_url() . route_to('delete-photo', $photo->id) ?>" onclick="return confirm('Yakin ingin menghapus Photo ini?')" class="btn btn-danger">
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
    $("#photo-table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#photo-table-wrapper');
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