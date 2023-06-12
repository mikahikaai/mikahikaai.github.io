<?php
$database = new Database;
$db = $database->getConnection();

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
          <li class="breadcrumb-item">Detail Data Pelayanan</li>
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
      <h3 class="card-title">Data Detail pelayanan</h3>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="id_pelanggan">Pilih Nama Pelanggan</label>
              <select style="text-transform: uppercase;" name="id_pelanggan" class="form-control" disabled>
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
              <select style="text-transform: uppercase;" name="id_dokter" class="form-control" disabled>
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
              <input type="date" name="tgl_pelayanan" class="form-control" value="<?= $rowpelayanan['tgl_pelayanan'] ?>" style="text-transform: uppercase;" disabled>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="keluhan_pasien">Keluhan Pasien</label>
              <br>
              <textarea style="text-transform: uppercase;" name="keluhan_pasien" rows="4" disabled><?= $rowpelayanan['keluhan_pasien'] ?></textarea>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="diagnosa">Diagnosa</label>
              <br>
              <textarea name="diagnosa" rows="4" disabled><?= $rowpelayanan['diagnosa'] ?></textarea>
            </div>
          </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
            <label for="ket">Keterangan</label>
            <input type="text-transform: uppercase" name="ket" class="form-control" value="<?=$rowpelayanan['ket'] ?>" style="text-transform: uppercase;" disabled>
          </div>
        </div>
        <a href="?page=pelayananread" class="btn btn-danger btn-sm float-right mt-2">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
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