<?php
$database = new Database;
$db = $database->getConnection();

$selectpelanggansql = "SELECT * FROM data_pelanggan";
$stmt_pelanggan = $db->prepare($selectpelanggansql);
$stmt_pelanggan->execute();

$selectobatsql = "SELECT * FROM obat WHERE stok_obat > 0 ORDER BY nama_obat ASC";
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
        <h1 class="m-0">Penjualan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=penjualanread">Penjualan</a></li>
          <li class="breadcrumb-item">Tambah Penjualan</li>
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
      <h3 class="card-title">Data Tambah Penjualan</h3>
    </div>
    <div class="card-body">
      <form action="?page=dopenjualancreate" method="post" class="needs-validation" novalidate>
        <div class="row">
          <div class="col-md-9">
            <div class="form-group">
              <label for="id_pelanggan">Pilih Nama Pelanggan</label>
              <select style="text-transform: uppercase;" name="id_pelanggan" class="form-control" required>
                <option value=""></option>
                <?php
                while ($rowpelanggan = $stmt_pelanggan->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value=<?= $rowpelanggan['id_pelanggan'] ?>><?= $rowpelanggan['nama'] ?></option>
                <?php };
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="tgl_penjualan">Tanggal Penjualan</label>
              <input type="date" name="tgl_penjualan" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Penjualan Obat</h3>
            <button type="button" class="btn btn-sm btn-success float-right" name="tambah_penjualan"><i class="fa fa-plus"></i></button>
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
                    <label for="jumlah_obat[]">Jumlah</label>
                    <input type="number" name="jumlah_obat[]" class="form-control" min="1"  value="<?= isset($_POST['button_create']) ? $_POST['jumlah_obat'] : '' ?>" style="text-transform: uppercase;" required>
                    <div class="invalid-feedback">
                      Jumlah pembelian obat melebihi stok!
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label for="harga[]">Harga</label>
                    <input type="number" name="harga[]" class="form-control" value="<?= isset($_POST['button_create']) ? $_POST['jumlah'] : '' ?>" style="text-transform: uppercase;" required readonly>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <label for="subtotal">Total</label>
                    <div class="input-group">
                      <input type="number" name="subtotal" class="form-control" value="0" style="text-transform: uppercase;" readonly>
                      <div class="input-group-append ml-3">
                        <button type="button" class="btn btn-sm btn-danger form-control" name="hapus_penjualan"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
              <input type="number" name="total" class="form-control" value="0" readonly>
            </div>
          </div>
        </div>
        <a href="?page=penjualanread" class="btn btn-danger btn-sm float-right mt-2">
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
  (function() {
    var regExp = /[a-z]/i;

    $(document).on('keypress', 'input[name="jumlah_obat[]"]', function(e) {
      // return false;
      var value = String.fromCharCode(e.which) || e.key;

      // No letters
      if (regExp.test(value)) {
        e.preventDefault();
        return false;
      }
    })
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
  })()

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
    html += '<input type="number" name="jumlah_obat[]" class="form-control" min="1" value="<?= isset($_POST['button_create']) ? $_POST['jumlah_obat'] : '' ?>" style="text-transform: uppercase;" required>';
    html += '<div class="invalid-feedback">';
    html += 'Jumlah pembelian obat melebihi stok!';
    html += '</div>';
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
        $(e.target).parents('.row:first').find("input[name='jumlah_obat[]']").val(1);
        $(e.target).parents('.row:first').find("input[name='jumlah_obat[]']").attr('max', data[1]);
        // if ($(e.target).parents('.row:first').find("input[name='jumlah_obat[]']")>data[1]) {

        // }
        var currentJumlah = $(e.target).parents('.row').find('input[name="jumlah_obat[]"]').val();
        var currentHarga = $(e.target).parents('.row').find('input[name="harga[]"]').val();
        $(e.target).parents('.row').find("input[name='subtotal']").val(currentHarga * currentJumlah);


      }
    });
  });
</script>