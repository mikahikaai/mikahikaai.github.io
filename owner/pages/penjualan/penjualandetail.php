<?php
$database = new Database;
$db = $database->getConnection();

$selectpelanggansql = "SELECT * FROM data_pelanggan";
$stmt_pelanggan = $db->prepare($selectpelanggansql);
$stmt_pelanggan->execute();

$selectobatsql = "SELECT * FROM obat";
$stmt_obat = $db->prepare($selectobatsql);

$selectpenjualansql = "SELECT * FROM penjualan pj INNER join obat o on pj.id_obat = o.id_obat WHERE no_penjualan=?";
$stmt_penjualan = $db->prepare($selectpenjualansql);
$stmt_penjualan->bindParam(1, $_GET['id']);
$stmt_penjualan->execute();
$rowpenjualan = $stmt_penjualan->fetch(PDO::FETCH_ASSOC);


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
        <h1 class="m-0">Penjualan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=penjualanread">Penjualan</a></li>
          <li class="breadcrumb-item">Detail Penjualan</li>
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
      <h3 class="card-title">Data Detail Penjualan</h3>
    </div>
    <div class="card-body">
      <form action="?page=dopenjualanupdate&&id=<?= $_GET['id'] ?>" method="post">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="no_penjualan">Nomor Penjualan</label>
              <input name="no_penjualan" placeholder="Masukkan No. Penjualan" class="form-control" style="text-transform: uppercase;" value="<?= $_GET['id'] ?>"readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="id_pelanggan">Pilih Nama Pelanggan</label>
              <select style="text-transform: uppercase;" name="id_pelanggan" class="form-control" disabled>
                <?php
                while ($rowpelanggan = $stmt_pelanggan->fetch(PDO::FETCH_ASSOC)) {
                  $selected = $rowpelanggan['id_pelanggan'] == $rowpenjualan['id_pelanggan'] ? 'selected' : '' ?>
                  <option <?= $selected ?> value=<?= $rowpelanggan['id_pelanggan'] ?>><?= $rowpelanggan['nama'] ?></option>
                <?php };
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="tgl_penjualan">Tanggal Penjualan</label>
              <input type="date" name="tgl_penjualan" class="form-control" value="<?= $rowpenjualan['tgl_penjualan'] ?>" readonly>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Penjualan Obat</h3>
            <button type="button" class="btn btn-sm btn-success float-right" name="tambah_penjualan" disabled><i class="fa fa-plus"></i></button>
          </div>
          <div class="card-body">
            <div id="dinamis">
              <?php
              $total_penjualan = 0;
              $stmt_penjualan->execute();
              while ($rowpenjualan = $stmt_penjualan->fetch(PDO::FETCH_ASSOC)) {
                $total_penjualan += $rowpenjualan['jumlah_obat'] * $rowpenjualan['harga_jual'] ?>
                <div class="row">
                  <div class="col-md">
                    <div class="form-group">
                      <label for="id_obat[]">Nama Obat</label>
                      <select name="id_obat[]" class="form-control" disabled>
                        <option value=""></option>
                        <?php
                        $stmt_obat->execute();
                        while ($rowobat = $stmt_obat->fetch(PDO::FETCH_ASSOC)) {
                          $selected = $rowobat['id_obat'] == $rowpenjualan['id_obat'] ? 'selected' : '' ?>
                          <option <?= $selected ?> value=<?= $rowobat['id_obat'] ?>><?= strtoupper($rowobat['nama_obat']) ?></option>
                        <?php };
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-group">
                      <label for="jumlah_obat[]">Jumlah</label>
                      <input type="number" name="jumlah_obat[]" class="form-control" value="<?= $rowpenjualan['jumlah_obat'] ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-group">
                      <label for="harga[]">Harga</label>
                      <input type="number" name="harga[]" class="form-control" value="<?= $rowpenjualan['harga_jual'] ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="form-group">
                      <label for="subtotal">Total</label>
                      <div class="input-group">
                        <input type="number" name="subtotal" class="form-control" value="<?= $rowpenjualan['jumlah_obat'] * $rowpenjualan['harga_jual'] ?>" readonly>
                        <div class="input-group-append ml-3">
                          <button type="button" class="btn btn-sm btn-danger form-control" name="hapus_penjualan" disabled><i class="fa fa-times"></i></button>
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
          <div class="col-md-3"></div>
          <div class="col-md-3"></div>
          <div class="col-md-3"></div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="total">Total Penjualan</label>
              <input type="number" name="total" class="form-control" value="<?= $total_penjualan ?>" readonly>
            </div>
          </div>
        </div>
        <a href="?page=penjualanread" class="btn btn-danger btn-sm float-right mt-2">
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
  $(document).on('click', 'button[name="tambah_penjualan"]', function(e) {
    var html = '';
    html += '<div class="row">';
    html += '<div class="col-md">';
    html += '<div class="form-group">';
    html += '<label for="id_obat[]">Nama Obat</label>'
    html += '<select name="id_obat[]" class="form-control" required>'
    html += '<option value=""></option>'
    html += '<?php $stmt_obat->execute();
              while ($rowobat = $stmt_obat->fetch(PDO::FETCH_ASSOC)) { ?>';
    html += '<option value=<?= $rowobat['id_obat'] ?>><?= strtoupper($rowobat['nama_obat']) ?></option>';
    html += '<?php }; ?>';
    html += '</select>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-md">';
    html += '<div class="form-group">';
    html += '<label for="jumlah_obat[]">Jumlah</label>';
    html += '<input type="number" name="jumlah_obat[]" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['jumlah_obat'] : '' ?>" style="text-transform: uppercase;" required>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-md">';
    html += '<div class="form-group">';
    html += '<label for="harga[]">Harga</label>';
    html += '<input type="number" name="harga[]" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['jumlah'] : '' ?>" style="text-transform: uppercase;" required readonly>';
    html += '</div>';
    html += '</div>';
    html += '<div class="col-md">';
    html += '<div class="form-group">';
    html += '<label for="subtotal">Total</label>';
    html += '<div class="input-group">';
    html += '<input type="number" name="subtotal" class="form-control" value="0" style="text-transform: uppercase;" readonly>';
    html += '<div class="input-group-append ml-3">';
    html += '<button type="button" class="btn btn-sm btn-danger form-control" name="hapus_penjualan"><i class="fa fa-times"></i></button>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
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