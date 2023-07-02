<?php
$database = new Database;
$db = $database->getConnection();

$selectsupliersql = "SELECT * FROM suplier";
$stmt_suplier = $db->prepare($selectsupliersql);
$stmt_suplier->execute();

$selectobatsql = "SELECT * FROM obat";
$stmt_obat = $db->prepare($selectobatsql);

$selectpembeliansql = "SELECT * FROM pembelian WHERE no_faktur=?";
$stmt_pembelian = $db->prepare($selectpembeliansql);
$stmt_pembelian->bindParam(1, $_GET['id']);
$stmt_pembelian->execute();
$rowpembelian = $stmt_pembelian->fetch(PDO::FETCH_ASSOC);


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
      <form action="?page=dopembelianupdate&&id=<?= $_GET['id']?>" method="post">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="no_faktur">Nomor Faktur</label>
              <input type="text" name="no_faktur" placeholder="Masukkan No. Faktur" class="form-control" value="<?= $_GET['id'] ?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="id_suplier">Pilih Nama Suplier</label>
              <select name="id_suplier" class="form-control" required>
                <?php
                while ($rowsuplier = $stmt_suplier->fetch(PDO::FETCH_ASSOC)) {
                  $selected = $rowsuplier['id_suplier'] == $rowpembelian['id_suplier'] ? 'selected' : '' ?>
                  <option <?= $selected ?> value=<?= $rowsuplier['id_suplier'] ?>><?= $rowsuplier['nama_suplier'] ?></option>
                <?php };
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="tgl_pembelian">Tanggal Pembelian</label>
              <input type="date" name="tgl_pembelian" class="form-control" value="<?= $rowpembelian['tgl_pembelian'] ?>">
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
              <?php
              $total_pembelian = 0;
              $stmt_pembelian->execute();
              while ($rowpembelian = $stmt_pembelian->fetch(PDO::FETCH_ASSOC)) {
                $total_pembelian += $rowpembelian['jumlah'] * $rowpembelian['harga'] ?>
                <div class="row">
                  <div class="col-md">
                    <div class="form-group">
                      <label for="id_obat[]">Nama Obat</label>
                      <select name="id_obat[]" class="form-control" required>
                        <option value=""></option>
                        <?php
                        $stmt_obat->execute();
                        while ($rowobat = $stmt_obat->fetch(PDO::FETCH_ASSOC)) {
                          $selected = $rowobat['id_obat'] == $rowpembelian['id_obat'] ? 'selected' : '' ?>
                          <option <?= $selected ?> value=<?= $rowobat['id_obat'] ?>><?= strtoupper($rowobat['nama_obat']) ?></option>
                        <?php };
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-group">
                      <label for="jumlah[]">Jumlah</label>
                      <input type="number" name="jumlah[]" class="form-control" value="<?= $rowpembelian['jumlah'] ?>" required>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-group">
                      <label for="harga[]">Harga</label>
                      <input type="number" name="harga[]" class="form-control" value="<?= $rowpembelian['harga'] ?>" required>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-group">
                      <label for="subtotal">Total</label>
                      <input type="number" name="subtotal" class="form-control" value="<?= $rowpembelian['jumlah'] * $rowpembelian['harga'] ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-group">
                      <label for="ex_obat[]">Expired</label>
                      <div class="input-group">
                        <input type="date" name="ex_obat[]" class="form-control" value="<?= $rowpembelian['ex_obat'] ?>" required>
                        <div class="input-group-append ml-3">
                          <button type="button" class="btn btn-sm btn-danger form-control" name="hapus_pembelian"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="jenis_pembelian">Jenis Transaksi</label>
              <select style="text-transform: uppercase;" name="jenis_pembelian" class="form-control" required>
                <?php
                $options = array('tunai', 'kredit');
                foreach ($options as $option) {
                  $stmt_pembelian->execute();
                  $rowpembelian = $stmt_pembelian->fetch(PDO::FETCH_ASSOC);
                  $selected = $rowpembelian['jenis_pembelian'] == $option ? 'selected' : '';
                ?>
                  <option style="text-transform: uppercase;" <?= $selected ?> value="<?= $option ?>"><?= $option ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="tgl_jatuh_tempo">Tanggal Jatuh Tempo</label>
              <input type="date" name="tgl_jatuh_tempo" class="form-control" value="<?= $rowpembelian['tgl_jatuh_tempo'] ?>">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="total">Total Pembelian</label>
              <input type="number" name="total" class="form-control" value="<?= $total_pembelian ?>" readonly>
            </div>
          </div>
        </div>
        <a href="?page=pembelianread" class="btn btn-danger btn-sm float-right mt-2">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
        <button type="submit" name="button_edit" class="btn btn-success btn-sm float-right mr-1 mt-2">
          <i class="fa fa-save"></i> Ubah
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
  $(document).on('click', 'button[name="tambah_penjualan"]', function(e) {
    var html = '';
    html += '<div class="row">';
    html += '<div class="col-md">';
    html += '<div class="form-group">';
    html += '<label for="id_obat[]">Nama Obat</label>'
    html += '<select name="id_obat[]" class="form-control" required>'
    html +='<option value=""></option>'
    html +='<?php $stmt_obat->execute(); while ($rowobat = $stmt_obat->fetch(PDO::FETCH_ASSOC)) { ?>';
    html +='<option value=<?= $rowobat['id_obat'] ?>><?= strtoupper($rowobat['nama_obat']) ?></option>';
    html +='<?php };?>';
    html +='</select>';
    html +='</div>';
    html +='</div>';
    html +='<div class="col-md">';
    html +='<div class="form-group">';
    html +='<label for="jumlah_obat[]">Jumlah</label>';
    html +='<input type="number" name="jumlah_obat[]" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['jumlah_obat'] : '' ?>" style="text-transform: uppercase;" required>';
    html +='</div>';
    html +='</div>';
    html +='<div class="col-md">';
    html +='<div class="form-group">';
    html +='<label for="harga[]">Harga</label>';
    html +='<input type="number" name="harga[]" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['jumlah'] : '' ?>" style="text-transform: uppercase;" required readonly>';
    html +='</div>';
    html +='</div>';
    html +='<div class="col-md">';
    html +='<div class="form-group">';
    html +='<label for="subtotal">Total</label>';
    html +='<div class="input-group">';
    html +='<input type="number" name="subtotal" class="form-control" value="0" style="text-transform: uppercase;" readonly>';
    html +='<div class="input-group-append ml-3">';
    html +='<button type="button" class="btn btn-sm btn-danger form-control" name="hapus_penjualan"><i class="fa fa-times"></i></button>';
    html +='</div>';
    html +='</div>';
    html +='</div>';
    html +='</div>';
    html +='</div>';
    $('#dinamis').append(html);
  });

  // var total = 0;

  $(document).on('click', 'button[name="hapus_penjualan"]', function(e) {
    $(e.target).closest('.row').remove();
    var total = 0;
    $('input[name="subtotal"]').each(function() {
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
    $('input[name="subtotal"]').each(function() {
      total += parseInt($(this).val());
    });
    // console.log(total);
    $("input[name='total']").val(total).trigger('change');
  });

  $(document).on('change', 'input[name="jumlah_obat[]"]', function(e) {
    var currentJumlah = $(e.target).parents('.row').find('input[name="jumlah_obat[]"]').val();
    var currentHarga = $(e.target).parents('.row').find('input[name="harga[]"]').val();
    $(e.target).parents('.row').find("input[name='subtotal']").val(currentHarga * currentJumlah);
    var total = 0;
    $('input[name="subtotal"]').each(function() {
      total += parseInt($(this).val());
    });
    // console.log(total);
    $("input[name='total']").val(total).trigger('change');
  });

  $(document).on('change', 'select[name="id_obat[]"]', function(e) {
    var optionSelected = $("option:selected", e.target);
    var valueSelected = e.target.value;
    // console.log(valueSelected);
    $.ajax({
      url: "./pages/penjualan/dataharga.php?id=" + valueSelected,
      method: "GET",
      dataType: 'json',
      success: function(data) {
        // console.log(data);
        $(e.target).parents('.row:first').find("input[name='harga[]']").val(data[0]);
      }
    });
  });
</script>