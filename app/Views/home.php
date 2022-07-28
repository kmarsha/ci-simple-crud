<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
  Home
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-10">
          <div class="card text-center">
            <div class="card-body">
              <h1 class="display-3">Simple CRUD Management</h1>
              <h2 class="display-4">Codeigniter4</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?= $this->endSection() ?>