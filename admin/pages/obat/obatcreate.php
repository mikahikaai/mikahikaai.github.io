<?php
$database = new Database;
$db = $database->getConnection();

if (isset($_POST['button_create'])) {
  $insertsql = "INSERT INTO obat (id_obat, nama_obat, jenis_obat, harga_jual, harga_beli, minimal_stok, stok_obat, khasiat, ket) values (NULL,?,?,?,?,?,?,?,?)";
  $stmt = $db->prepare($insertsql);
  $stmt->bindParam(1, $_POST['nama_obat']);
  $stmt->bindParam(2, $_POST['jenis_obat']);
  $stmt->bindParam(3, $_POST['harga_jual']);
  $stmt->bindParam(4, $_POST['harga_beli']);
  $stmt->bindParam(5, $_POST['minimal_stok']);
  $stmt->bindParam(6, $_POST['stok_obat']);
  $stmt->bindParam(7, $_POST['khasiat']);
  $stmt->bindParam(8, $_POST['ket']);
  if ($stmt->execute()) {
    $_SESSION['hasil_create'] = true;
    $_SESSION['pesan'] = "Berhasil Menyimpan Data";
  } else {
    $_SESSION['hasil_create'] = false;
    $_SESSION['pesan'] = "Gagal Menyimpan Data";
  }
  echo '<meta http-equiv="refresh" content="0;url=?page=obatread"/>';
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
        <h1 class="m-0">Obat</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=obatread">Obat</a></li>
          <li class="breadcrumb-item">Tambah Obat</li>
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
      <h3 class="card-title">Data Tambah Obat</h3>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nama_obat">Nama Obat</label>
              <input type="text" name="nama_obat" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['nama_obat'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="jenis_obat">Jenis Obat</label>
              <select name="jenis_obat" class="form-control" required>
                <option value="">--Pilih Jenis Obat--</option>
                <?php
                $options = array('Tablet', 'Kapsul', 'Box', 'Sachet', 'Vial', 'Ampul', 'Unit', 'Botol',);
                foreach ($options as $option) {
                  $selected = $_POST['jenis_obat'] == $option ? 'selected' : '';
                  echo "<option value=\"" . $option . "\"" . $selected . ">" . $option . "</option>";
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="harga_jual">Harga Jual</label>
              <input type="number" name="harga_jual" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['harga_jual'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="harga_beli">Harga Beli</label>
              <input type="number" name="harga_beli" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['harga_beli'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="minimal_stok">Minimal Stok</label>
              <input type="number" name="minimal_stok" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['minimal_stok'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="stok_obat">Stok Obat</label>
              <input type="number" name="stok_obat" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['stok_obat'] : '' ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="khasiat">Khasiat</label>
          <br>
          <textarea name="khasiat" rows="4"><?= isset($_POST['button_create']) ? $_POST['khasiat'] : '' ?></textarea>
        </div>
        <div class="form-group">
          <label for="ket">Keterangan</label>
          <input type="text" name="ket" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['ket'] : '' ?>" style="text-transform: uppercase;">
        </div>
        <a href="?page=obatread" class="btn btn-danger btn-sm float-right mt-2">
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