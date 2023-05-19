<?php
$database = new Database;
$db = $database->getConnection();

if (isset($_POST['button_create'])) {
  $insertsql = "INSERT INTO suplier (id_suplier, nama_suplier, alamat, no_telp) values (NULL,?,?,?)";
  $stmt = $db->prepare($insertsql);
  $stmt->bindParam(1, $_POST['nama_suplier']);
  $stmt->bindParam(2, $_POST['alamat']);
  $stmt->bindParam(3, $_POST['no_telp']);
  if ($stmt->execute()) {
    $_SESSION['hasil_create'] = true;
    $_SESSION['pesan'] = "Berhasil Menyimpan Data";
  } else {
    $_SESSION['hasil_create'] = false;
    $_SESSION['pesan'] = "Gagal Menyimpan Data";
  }
  echo '<meta http-equiv="refresh" content="0;url=?page=suplierread"/>';
  exit;
}
?>

<style>
  textarea {
    resize: none;
    width: 100%;
  }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Suplier</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=suplieread">Suplier</a></li>
          <li class="breadcrumb-item">Tambah Suplier</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Tambah Suplier</h3>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nama_suplier">Nama Suplier</label>
              <input type="text" name="nama_suplier" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['nama_suplier'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="no_telp">No Telpon</label>
              <input type="text" name="no_telp" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['no_telp'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <br>
          <textarea name="alamat" rows="4"><?= isset($_POST['button_create']) ? $_POST['alamat'] : '' ?></textarea>
        </div>
        <a href="?page=suplierread" class="btn btn-danger btn-sm float-right mt-2">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
        <button type="submit" name="button_create" class="btn btn-success btn-sm float-right mr-1 mt-2">
          <i class="fa fa-save"></i> Simpan
        </button>
      </form>
    </div>
  </div>
</div>

<?php
include_once "../partials/scriptdatatables.php";
?>

<!-- /.content -->
<script>

</script>