<?php
$database = new Database;
$db = $database->getConnection();

if (isset($_POST['button_edit'])) {

  $updatesql = "UPDATE data_dokter SET nama_dokter=?, spesialis=?, alamat=?, no_telp=? WHERE id_dokter=?";
  $stmt = $db->prepare($updatesql);
  $stmt->bindParam(1, $_POST['nama_dokter']);
  $stmt->bindParam(2, $_POST['spesialis']);
  $stmt->bindParam(3, $_POST['alamat']);
  $stmt->bindParam(4, $_POST['no_telp']);
  $stmt->bindParam(5, $_GET['id']);

  if ($stmt->execute()) {
    $_SESSION['hasil_update'] = true;
    $_SESSION['pesan'] = "Berhasil Mengubah Data";
  } else {
    $_SESSION['hasil_update'] = false;
    $_SESSION['pesan'] = "Gagal Mengubah Data";
  }
  echo '<meta http-equiv="refresh" content="0;url=?page=dokterread"/>';
  exit;
}

if (isset($_GET['id'])) {
  $selectsql = "SELECT * FROM data_dokter where id_dokter=?";
  $stmt = $db->prepare($selectsql);
  $stmt->bindParam(1, $_GET['id']);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
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
        <h1 class="m-0">Data Dokter]</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=dokterread">Dokter</a></li>
          <li class="breadcrumb-item">Update Data Dokter</li>
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
      <h3 class="card-title">Data Update Dokter</h3>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nama_dokter">Nama Dokter</label>
              <input type="text" name="nama_dokter" class="form-control" value="<?= $row['nama_dokter'] ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="spesialis">spesialis</label>
              <input type="text" name="spesialis" class="form-control" value="<?= $row['spesialis'] ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <br>
          <textarea name="alamat" rows="4" required><?= $row['alamat'] ?></textarea>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="no_telp">No Telpon</label>
              <input type="number" name="no_telp" class="form-control" value="<?= $row['no_telp'] ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
        <a href="?page=dokterread" class="btn btn-danger btn-sm float-right mt-2">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
        <button type="submit" name="button_edit" class="btn btn-primary btn-sm float-right mr-1 mt-2">
          <i class="fa fa-save"></i> Ubah
        </button>
      </form>
    </div>
  </div>
</div>
<!-- /.content -->

<?php
include_once "../partials/scriptdatatables.php";
?>

<script>

</script>