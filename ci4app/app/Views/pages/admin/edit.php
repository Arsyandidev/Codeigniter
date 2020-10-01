<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card-body">
          <form action="/admin/edit_data/<?= $kandidat['id']; ?>" method="POST" enctype="multipart/form-data">
          <?= csrf_field(); ?>
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Kandidat</label>
              <input type="text" name="nama" class="form-control" value="<?= $kandidat['nama_kandidat']; ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Prodi Kandidat</label>
              <input type="text" name="prodi" class="form-control" value="<?= $kandidat['prodi_kandidat']; ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Foto Kandidat</label>
                <input type="file" name="foto" class="form-control" value="<?= $kandidat['foto']; ?>">
              </div>
            <button type="submit" class="btn btn-success">Simpan</button>
          </form>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?= $this->endSection(); ?>