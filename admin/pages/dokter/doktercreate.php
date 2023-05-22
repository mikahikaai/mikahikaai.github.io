<?php
$database = new Database;
$db = $database->getConnection();

if (isset($_POST['button_create'])) {
  $insertsql = "INSERT INTO data_dokter (id_dokter, nama_dokter, spesialis, alamat, no_telp) values (NULL,?,?,?,?)";
  $stmt = $db->prepare($insertsql);
  $stmt->bindParam(1, $_POST['nama_dokter']);
  $stmt->bindParam(2, $_POST['spesialis']);
  $stmt->bindParam(3, $_POST['alamat']);
  $stmt->bindParam(4, $_POST['no_telp']);
  if ($stmt->execute()) {
    $_SESSION['hasil_create'] = true;
    $_SESSION['pesan'] = "Berhasil Menyimpan Data";
  } else {
    $_SESSION['hasil_create'] = false;
    $_SESSION['pesan'] = "Gagal Menyimpan Data";
  }
  echo '<meta http-equiv="refresh" content="0;url=?page=dokterread"/>';
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
        <h1 class="m-0">Data Dokter</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=dokterread">Data Dokter</a></li>
          <li class="breadcrumb-item">Tambah Dokter</li>
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
      <h3 class="card-title">Data Tambah Dokter</h3>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nama_dokter">Nama Dokter</label>
              <input type="text" name="nama_dokter" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['nama_dokter'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="spesialis">Spesialis</label>
              <input type="text" name="spesialis" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['spesialis'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <br>
          <textarea name="alamat" rows="4"><?= isset($_POST['button_create']) ? $_POST['alamat'] : '' ?></textarea>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="no_telp">No Telpon</label>
              <input type="text" name="no_telp" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['no_telp'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
        <a href="?page=dokterread" class="btn btn-danger btn-sm float-right mt-2">
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