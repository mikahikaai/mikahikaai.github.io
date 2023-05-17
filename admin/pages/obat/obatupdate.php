<?php
$database = new Database;
$db = $database->getConnection();

if (isset($_POST['button_edit'])) {

  $updatesql = "UPDATE obat SET nama_obat=?, jenis_obat=?, harga_jual=?, harga_beli=?, minimal_stok=?, stok_obat=?, khasiat=?, ket=?  WHERE id_obat=?";
  $stmt = $db->prepare($updatesql);
  $nama_obat = strtoupper($_POST['nama_obat']);
  $stmt->bindParam(1, $nama_obat);
  $stmt->bindParam(2, $_POST['jenis_obat']);
  $stmt->bindParam(3, $_POST['harga_jual']);
  $stmt->bindParam(4, $_POST['harga_beli']);
  $stmt->bindParam(5, $_POST['minimal_stok']);
  $stmt->bindParam(6, $_POST['stok_obat']);
  $stmt->bindParam(7, $_POST['khasiat']);
  $stmt->bindParam(8, $_POST['ket']);
  $stmt->bindParam(9, $_GET['id']);

  if ($stmt->execute()) {
    $_SESSION['hasil_update'] = true;
    $_SESSION['pesan'] = "Berhasil Mengubah Data";
  } else {
    $_SESSION['hasil_update'] = false;
    $_SESSION['pesan'] = "Gagal Mengubah Data";
  }
  echo '<meta http-equiv="refresh" content="0;url=?page=obatread"/>';
  exit;
  exit;
}

if (isset($_GET['id'])) {
  $selectsql = "SELECT * FROM obat where id_obat=?";
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
        <h1 class="m-0">Obat</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=obatread">Obat</a></li>
          <li class="breadcrumb-item">Update Obat</li>
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
      <h3 class="card-title">Data Update Obat</h3>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nama_obat">Nama Obat</label>
              <input type="text" name="nama_obat" class="form-control" value="<?= $row['nama_obat'] ?>" style="text-transform: uppercase;" required>
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
                  $selected = $row['jenis_obat'] == $option ? 'selected' : '';
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
              <input type="number" name="harga_jual" class="form-control" value="<?= $row['harga_jual'] ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="harga_beli">Harga Beli</label>
              <input type="number" name="harga_beli" class="form-control" value="<?= $row['harga_beli'] ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="minimal_stok">Minimal Stok</label>
              <input type="number" name="minimal_stok" class="form-control" value="<?= $row['minimal_stok'] ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="stok_obat">Stok Obat</label>
              <input type="number" name="stok_obat" class="form-control" value="<?= $row['stok_obat'] ?>" style="text-transform: uppercase;" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="khasiat">Khasiat</label>
          <br>
          <textarea name="khasiat" rows="4" required><?= $row['khasiat'] ?></textarea>
        </div>
        <div class="form-group">
          <label for="ket">Keterangan</label>
          <input type="text" name="ket" class="form-control" value="<?= $row['ket'] ?>" style="text-transform: uppercase;">
        </div>
        <a href="?page=obatread" class="btn btn-danger btn-sm float-right mt-2">
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