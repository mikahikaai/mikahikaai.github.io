<?php
$database = new Database;
$db = $database->getConnection();

if (isset($_POST['button_edit'])) {

  $updatesql = "UPDATE pelayanan SET id_pelanggan=?, id_dokter=?, tgl_pelayanan=?, keluhan_pasien=?, diagnosa=?, ket=? WHERE id_pelayanan=?";
  $stmt = $db->prepare($updatesql);
  $stmt->bindParam(1, $_POST['id_pelanggan']);
  $stmt->bindParam(2, $_POST['id_dokter']);
  $stmt->bindParam(3, $_POST['tgl_pelayanan']);
  $stmt->bindParam(4, $_POST['keluhan_pasien']);
  $stmt->bindParam(5, $_POST['diagnosa']);
  $stmt->bindParam(6, $_POST['ket']);
  $stmt->bindParam(7, $_GET['id']);

  if ($stmt->execute()) {
    $_SESSION['hasil_update'] = true;
    $_SESSION['pesan'] = "Berhasil Mengubah Data";
  } else {
    $_SESSION['hasil_update'] = false;
    $_SESSION['pesan'] = "Gagal Mengubah Data";
  }
  echo '<meta http-equiv="refresh" content="0;url=?page=pelayananread"/>';
  exit;
}

if (isset($_GET['id'])) {
  $selectsql = "SELECT * FROM pelayanan where id_pelayanan=?";
  $stmt = $db->prepare($selectsql);
  $stmt->bindParam(1, $_GET['id']);
  $stmt->execute();

  $rowpelayanan = $stmt->fetch(PDO::FETCH_ASSOC);
}

$selectpelanggansql = "SELECT * FROM data_pelanggan";
$stmt_pelanggan = $db->prepare($selectpelanggansql);
$stmt_pelanggan->execute();

$selectdoktersql = "SELECT * FROM data_dokter";
$stmt_dokter = $db->prepare($selectdoktersql);
$stmt_dokter->execute();

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
        <h1 class="m-0">Data Pelayanan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=pelayananread">Pelayanan</a></li>
          <li class="breadcrumb-item">Update Data Pelayanan</li>
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
      <h3 class="card-title">Data Update pelayanan</h3>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="id_pelanggan">Pilih Nama Pelanggan</label>
              <select style="text-transform: uppercase;" name="id_pelanggan" class="form-control" required>
                <?php

                while ($rowpelanggan = $stmt_pelanggan->fetch(PDO::FETCH_ASSOC)) {
                  $selected = $rowpelanggan['id_pelanggan'] == $rowpelayanan['id_pelanggan'] ? 'selected' : '' ?>
                  <option <?= $selected ?> value=<?= $rowpelanggan['id_pelanggan'] ?>><?= $rowpelanggan['nama'] ?></option>
                <?php };
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="id_dokter">Pilih Nama Dokter</label>
              <select style="text-transform: uppercase;" name="id_dokter" class="form-control" required>
                <?php

                while ($rowdokter = $stmt_dokter->fetch(PDO::FETCH_ASSOC)) {
                  $selected = $rowdokter['id_dokter'] == $rowpelayanan['id_dokter'] ? 'selected' : '' ?>
                  <option <?= $selected ?> value=<?= $rowdokter['id_dokter'] ?>><?= $rowdokter['nama_dokter'] ?></option>
                <?php };
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="tgl_pelayanan">Tanggal Pelayanan</label>
              <input type="date" name="tgl_pelayanan" class="form-control" value="<?= $rowpelayanan['tgl_pelayanan'] ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="keluhan_pasien">Keluhan Pasien</label>
              <br>
              <textarea style="text-transform: uppercase;" name="keluhan_pasien" rows="4" required><?= $rowpelayanan['keluhan_pasien'] ?></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="diagnosa">Diagnosa</label>
              <br>
              <textarea style="text-transform: uppercase;" name="diagnosa" rows="4" required><?= $rowpelayanan['diagnosa'] ?></textarea>
            </div>
          </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
            <label for="ket">Keterangan</label>
            <input style="text-transform: uppercase" name="ket" class="form-control" value="<?=$rowpelayanan['ket'] ?>" style="text-transform: uppercase;" >
          </div>
        </div>
        <a href="?page=pelayananread" class="btn btn-danger btn-sm float-right mt-2">
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