<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
  Edit User
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-8">
          <div class="card">
            <div class="card-header">
              <h2 class="text-center">Ubah Data User</h2>
            </div>
            <div class="card-body">
              <form id="form-user" action="<?= base_url() . route_to('update-user', $user->user_id) ?>" name="user" method="post">	

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
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control <?php echo (service('validation')->hasError('username')) ? 'is-invalid' : ''  ?>" name="username" id="username" value="<?= $user->username ?>" aria-describedby="UsernameHelp" placeholder="Masukkan Username . . . ">
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
                  <div class="row justify-content-between m-1">
                    <small id="passwordHelp" class="form-text text-muted">Kosongkan jika tidak ingin mengganti password</small>
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
            <div class="card-footer row justify-content-end">
              <button class="btn btn-primary" type="submit" id="send_form" form="form-user">Ubah</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?= $this->endSection() ?>