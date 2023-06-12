<?php
$database = new Database;
$db = $database->getConnection();

if (isset($_POST['button_create'])) {
  $insertsql = "INSERT INTO data_pelanggan (id_pelanggan, nama, tgl_lahir, jenis_kelamin, no_ktp, alamat, no_telp) values (NULL,?,?,?,?,?,?)";
  $stmt = $db->prepare($insertsql);
  $stmt->bindParam(1, $_POST['nama']);
  $stmt->bindParam(2, $_POST['tgl_lahir']);
  $stmt->bindParam(3, $_POST['jenis_kelamin']);
  $stmt->bindParam(4, $_POST['no_ktp']);
  $stmt->bindParam(5, $_POST['alamat']);
  $stmt->bindParam(6, $_POST['no_telp']);
  if ($stmt->execute()) {
    $_SESSION['hasil_create'] = true;
    $_SESSION['pesan'] = "Berhasil Menyimpan Data";
  } else {
    $_SESSION['hasil_create'] = false;
    $_SESSION['pesan'] = "Gagal Menyimpan Data";
  }
  echo '<meta http-equiv="refresh" content="0;url=?page=pelangganread"/>';
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
        <h1 class="m-0">Data Pelanggan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=pelangganread">Data Pelanggan</a></li>
          <li class="breadcrumb-item">Tambah Pelanggan</li>
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
      <h3 class="card-title">Data Tambah Pelanggan</h3>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nama">Nama Pelanggan</label>
              <input type="text" name="nama" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['nama'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="no_ktp">No KTP</label>
              <input type="text" name="no_ktp" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['no_ktp'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="tgl_lahir">Tanggal Lahir</label>
              <input type="date" name="tgl_lahir" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['tgl_lahir'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
              <label for="jenis_kelamin">Jenis Kelamin</label>
              <select name="jenis_kelamin" class="form-control" required>
                <option value="">--Pilih Jenis Kelamin--</option>
                <?php
                $options = array('LAKI - LAKI', 'PEREMPUAN',);
                foreach ($options as $option) {
                  $selected = $_POST['jenis_kelamin'] == $option ? 'selected' : '';
                  echo "<option value=\"" . $option . "\"" . $selected . ">" . $option . "</option>";
                }
                ?>
              </select>
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
        <a href="?page=pelangganread" class="btn btn-danger btn-sm float-right mt-2">
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