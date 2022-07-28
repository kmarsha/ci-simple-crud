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
              <h2 class="text-center">Tambah Karyawan Baru</h2>
            </div>
            <div class="card-body">
              <form action="<?= base_url() . route_to('create-employee') ?>" name="karyawan" id="karyawan" method="post">	

                <?php
                  if (session()->has('error')) {
                    ?>
                    <div class="alert alert-danger">
                      <?= session()->getFlashdata('error') ?>
                    </div>
                    <?php
                  }
                ?>

                <div class="alert alert-success d-none" id="res_message">
                  
                </div>

                <div class="form-group mb-3">
                  <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                  <input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" aria-describedby="nama_karyawanHelp" placeholder="Masukkan Nama Karyawan . . . ">
                </div>
                <div class="form-group mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" id="username" aria-describedby="UsernameHelp" placeholder="Masukkan Username . . . ">
                  <div class="row justify-content-end m-1">
                    <span class="text-danger" role="alert">
                        <small id="usernameError"></small>
                    </span>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp" placeholder="Masukkan password . . . ">
                </div>
                <div class="form-group mb-3">
                  <label for="usia" class="form-label">Usia</label>
                  <input type="number" min="1" class="form-control" name="usia" id="usia" aria-describedby="usiaHelp" placeholder="Masukkan Usia . . . ">
                </div>
                <div class="mb-3">
                  <label for="vaksin1" class="form-label">Status Vaksin 1</label>
                  <select class="form-control" name="vaksin1" id="vaksin1">
                    <option value="">---Pilih Status Vaksin---</option>
                    <option value="belum" selected>Belum Vaksin</option>
                    <option value="sudah">Sudah Vaksin</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="vaksin2" class="form-label">Status Vaksin 2</label>
                  <select class="form-control" name="vaksin2" id="vaksin2">
                    <option value="">---Pilih Status Vaksin---</option>
                    <option value="belum" selected>Belum Vaksin</option>
                    <option value="sudah">Sudah Vaksin</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="vaksin3" class="form-label">Status Vaksin 3</label>
                  <select class="form-control" name="vaksin3" id="vaksin3">
                    <option value="">---Pilih Status Vaksin---</option>
                    <option value="belum" selected>Belum Vaksin</option>
                    <option value="sudah">Sudah Vaksin</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="card-footer row justify-content-end">
              <button class="btn btn-primary" type="submit" id="send_form" form="karyawan">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
  <script>
    $(document).ready(function() {
      $("#karyawan").validate({
        rules: {
          nama_karyawan: {
            required: true,
          },
          username: {
            required: true,
            alphanumeric: true,
            minlength: 3,
            // unique: 
          },
          password: {
            required: true,
            alphanumeric: true,
            minlength: 4,
          },
          usia: {
            required: true,
          },
        },
        messages: {
          nama_karyawan: {
            required: 'Nama Karyawan wajib diisi',
          },
          username: {
            required: 'Username wajib diisi',
            alphanumeric: 'Username hanya boleh berisi huruf, angka, dan underscore saja',
            minlength: 'Username harus lebih dari sama dengan 3 karakter'
          },
          password: {
            required: 'Password wajib diisi',
            alphanumeric: 'Password hanya boleh berisi huruf, angka, dan underscore saja',
            minlength: 'Password harus lebih dari sama dengan 4 karakter'
          },
          usia: {
            required: 'Kolom Usia wajib diisi',
          },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
          $('#send_form').html('Sending...');
          $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/karyawan",
            data: $('#karyawan').serialize(),
            dataType: "json",
            success: function (response) {
              console.log(response);
              var success = response.success;
              var error = response.error;
              if (success) {
                $('#send_form').html('Submit');
                $('#res_message').html(response.msg);
                // $('#res_message').show();
                $('#res_message').toggleClass('d-none');
                document.getElementById("karyawan").reset(); 
                setTimeout(function() {
                $('#res_message').toggleClass('d-none');
                $('#res_message').html('');
                location.href = '<?= base_url() ?>/karyawan';
                }, 5000);
              } else if (error) {
                $('#send_form').html('Submit');
                $('#usernameError').text(response.msg)
              }
            },
          });
        }
      })
    })
  </script>
<?= $this->endSection() ?>