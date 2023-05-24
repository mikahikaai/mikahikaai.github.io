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
  echo '<meta http-equiv="refresh" content="0;url=?page=pembelianread"/>';
  exit;
}

$selectsupliersql = "SELECT * FROM suplier";
$stmt_suplier = $db->prepare($selectsupliersql);
$stmt_suplier->execute();

$selectobatsql = "SELECT * FROM obat";
$stmt_obat = $db->prepare($selectobatsql);
$stmt_obat->execute();


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
        <h1 class="m-0">Pembelian</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=pembelianread">Pembelian</a></li>
          <li class="breadcrumb-item">Tambah Pembelian</li>
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
      <h3 class="card-title">Data Tambah Pembelian</h3>
    </div>
    <div class="card-body">
      <form action="?page=dopembeliancreate" method="post">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="no_faktur">Nomor Faktur</label>
              <input type="text" name="no_faktur" placeholder="Masukkan No. Faktur" class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="id_suplier">Pilih Nama Suplier</label>
              <select name="id_suplier" class="form-control" required>
                <option value=""></option>
                <?php
                while ($rowsuplier = $stmt_suplier->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value=<?= $rowsuplier['id_suplier'] ?>><?= $rowsuplier['nama_suplier'] ?></option>
                <?php };
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="tgl_pembelian">Tanggal Pembelian</label>
              <input type="date" name="tgl_pembelian" class="form-control">
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Pembelian Obat</h3>
            <button type="button" class="btn btn-sm btn-success float-right" name="tambah_pembelian"><i class="fa fa-plus"></i></button>
          </div>
          <div class="card-body">
            <div id="dinamis">
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label for="id_obat[]">Nama Obat</label>
                    <select name="id_obat[]" class="form-control" required>
                      <option value=""></option>
                      <?php
                      while ($rowobat = $stmt_obat->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value=<?= $rowobat['id_obat'] ?>><?= strtoupper($rowobat['nama_obat']) ?></option>
                      <?php };
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label for="jumlah[]">Jumlah</label>
                    <input type="number" name="jumlah[]" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['jumlah'] : '' ?>" style="text-transform: uppercase;" required>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label for="harga[]">Harga</label>
                    <input type="number" name="harga[]" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['jumlah'] : '' ?>" style="text-transform: uppercase;" required>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label for="subtotal">Total</label>
                    <input type="number" name="subtotal" class="form-control" value="0" style="text-transform: uppercase;" readonly>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label for="ex_obat[]">Expired</label>
                    <div class="input-group">
                      <input type="date" name="ex_obat[]" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['jumlah'] : '' ?>" style="text-transform: uppercase;" required>
                      <div class="input-group-append ml-3">
                        <button type="button" class="btn btn-sm btn-danger form-control" name="hapus_pembelian"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="jenis_pembelian">Jenis Transaksi</label>
              <select name="jenis_pembelian" class="form-control" required>
                <option value="tunai">Tunai</option>
                <option value="kredit">Kredit</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="tgl_jatuh_tempo">Tanggal Jatuh Tempo</label>
              <input type="date" name="tgl_jatuh_tempo" class="form-control">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="total">Total Pembelian</label>
              <input type="number" name="total" class="form-control" value="0" readonly>
            </div>
          </div>
        </div>
        <a href="?page=pembelianread" class="btn btn-danger btn-sm float-right mt-2">
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
  $(document).on('click', 'button[name="tambah_pembelian"]', function(e) {
    var html = '';
    html += '<div class="row">';
    html += '<div class="col-md">';
    html += '<div class="form-group">';
    html += '<label for="id_obat[]">Nama Obat</label>';
    html += '<select name="id_obat[]" class="form-control" required>';
    html += '<option value=""></option>';
    html += '<?php $stmt_obat->execute();
              while ($rowobat = $stmt_obat->fetch(PDO::FETCH_ASSOC)) { ?>';
    html += '<option value=<?= $rowobat["id_obat"] ?>><?= strtoupper($rowobat["nama_obat"]) ?></option>';
    html += '<?php }; ?>';
    html += '</select>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-md">';
    html += '<div class="form-group">';
    html += '<label for="jumlah[]">Jumlah</label>';
    html += '<input type="number" name="jumlah[]" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['jumlah'] : '' ?>" style="text-transform: uppercase;" required>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-md">';
    html += '<div class="form-group">';
    html += '<label for="harga[]">Harga</label>';
    html += '<input type="number" name="harga[]" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['jumlah'] : '' ?>" style="text-transform: uppercase;" required>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-md">';
    html += '<div class="form-group">';
    html += '<label for="subtotal">Total</label>';
    html += '<input type="number" name="subtotal" class="form-control" value="0" style="text-transform: uppercase;" readonly>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-md">';
    html += '<div class="form-group">';
    html += '<label for="ex_obat[]">Expired</label>';
    html += '<div class="input-group">';
    html += '<input type="date" name="ex_obat[]" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['jumlah'] : '' ?>" style="text-transform: uppercase;" required>';
    html += '<div class="input-group-append ml-3">';
    html += '<button type="button" class="btn btn-sm btn-danger form-control" name="hapus_pembelian"><i class="fa fa-times"></i></button>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';

    $('#dinamis').append(html);
  });

  // var total = 0;

  $(document).on('click', 'button[name="hapus_pembelian"]', function(e) {
    $(e.target).closest('.row').remove();
    var total = 0;
    $('input[name="subtotal"]').each(function(){
      total += parseInt($(this).val());
    });
    // console.log(total);
    $("input[name='total']").val(total);
  });

  $(document).on('change', 'input[name="harga[]"]', function(e) {
    var currentJumlah = $(e.target).parents('.row').find('input[name="jumlah[]"]').val();
    var currentHarga = $(e.target).parents('.row').find('input[name="harga[]"]').val();
    $(e.target).parents('.row').find("input[name='subtotal']").val(currentHarga * currentJumlah);
    var total = 0;
    $('input[name="subtotal"]').each(function(){
      total += parseInt($(this).val());
    });
    // console.log(total);
    $("input[name='total']").val(total).trigger('change');
  });

  $(document).on('change', 'input[name="jumlah[]"]', function(e) {
    var currentJumlah = $(e.target).parents('.row').find('input[name="jumlah[]"]').val();
    var currentHarga = $(e.target).parents('.row').find('input[name="harga[]"]').val();
    $(e.target).parents('.row').find("input[name='subtotal']").val(currentHarga * currentJumlah);
    var total = 0;
    $('input[name="subtotal"]').each(function(){
      total += parseInt($(this).val());
    });
    // console.log(total);
    $("input[name='total']").val(total).trigger('change');
  });
</script>