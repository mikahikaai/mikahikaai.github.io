<?php
$database = new Database;
$db = $database->getConnection();

if (isset($_GET['id'])) {
  $selectsql = "SELECT * FROM data_pelanggan where id_pelanggan=?";
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
        <h1 class="m-0">Pelanggan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=pelanggnaread">Pelanggan</a></li>
          <li class="breadcrumb-item">Detail Pelanggan</li>
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
      <h3 class="card-title">Data Detail Pelanggan</h3>
    </div>
    <div class="card-body">
      <form action="" method="post">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nama_suplier">Nama Pelanggan</label>
              <input type="text" name="nama" class="form-control" value="<?= $row['nama'] ?>" style="text-transform: uppercase;" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="no_ktp">No KTP</label>
              <input type="number" name="no_ktp" class="form-control" value="<?= $row['no_ktp'] ?>" style="text-transform: uppercase;" readonly>
            </div>
          </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <br>
          <textarea name="alamat" rows="4" readonly><?= $row['alamat'] ?></textarea>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label for="no_telp">No Telpon</label>
              <input type="text" name="no_telp" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['no_telp'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
        <a href="?page=pelangganread" class="btn btn-danger btn-sm float-right mt-2">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
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