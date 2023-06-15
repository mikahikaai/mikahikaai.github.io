<?php include_once "../partials/cssdatatables.php" ?>

<?php
if (isset($_SESSION['hasil'])) {
?>
  <?php if ($_SESSION['hasil']) {
  ?>
    <div class="alert alert-success alert-dismissable">
      <button class="close" type="button" data-dismiss="alert" aria-hidden="true">X</button>
      <h5><i class="icon fas fa-check"></i>Sukses</h5>
      <?= $_SESSION['pesan'] ?>
    </div>

  <?php
  } else {
  ?>
    <div class="alert alert-danger alert-dismissable">
      <button class="close" type="button" data-dismiss="alert" aria-hidden="true">X</button>
      <h5><i class="icon fas fa-times"></i>Terjadi Kesalahan</h5>
      <?= $_SESSION['pesan'] ?>
    </div>
  <?php }
  unset($_SESSION['hasil']);
  unset($_SESSION['pesan']);
} elseif (isset($_SESSION['hasil_delete'])) {
  if ($_SESSION['hasil_delete']) {
  ?>
    <div id='hasil_delete'></div>
  <?php }
  unset($_SESSION['hasil_delete']);
} elseif (isset($_SESSION['hasil_create'])) {
  if ($_SESSION['hasil_create']) {
  ?>
    <div id='hasil_create'></div>
  <?php }
  unset($_SESSION['hasil_create']);
} elseif (isset($_SESSION['hasil_update'])) {
  if ($_SESSION['hasil_update']) {
  ?>
    <div id='hasil_update'></div>
<?php }
  unset($_SESSION['hasil_update']);
} ?>


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
          <li class="breadcrumb-item active">Pembelian</li>
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
      <h3 class="card-title">Data Pembelian</h3>
      <a href="report/reportrekappembelian.php" target="_blank" class="btn btn-warning btn-sm float-right">
        <i class="fa fa-file-pdf"></i> Export PDF
      </a>
    </div>
    <div class="card-body">
      <table id="mytable" class="table table-bordered" style="white-space: nowrap;" width="100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>No Faktur</th>
            <th>Tanggal Faktur</th>
            <th>Nama Obat</th>
            <th>Qty</th>
            <th>Harga Pembelian</th>
            <th>Total</th>
            <th>Expired Obat</th>
            <th>Nama Suplier</th>
            <th>Tanggal Jatuh Tempo</th>
            <th>Jenis Pembelian</th>
            <th style="display: flex;">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $database = new Database;
          $db = $database->getConnection();

          $selectsql = 'SELECT * FROM pembelian p inner join obat o on p.id_obat = o.id_obat inner join suplier s on p.id_suplier = s.id_suplier ORDER BY no_faktur ASC';
          $stmt = $db->prepare($selectsql);
          $stmt->execute();

          $no = 1;
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // $str = $row['alamat_dropping'];
            // if (strlen($str) > 80)
            //     $str = substr($str, 0, 77) . '...';
          ?>
            <tr>
              <td><?= $no++ ?></td>
              <td style="text-transform: uppercase;"><?= $row['no_faktur'] ?></td>
              <td><?= $row['tgl_pembelian'] ?></td>
              <td style="text-transform: uppercase;"><?= $row['nama_obat'] ?></td>
              <td><?= $row['jumlah'] ?></td>
              <td><?= 'Rp. ' . number_format($row['harga'], 0, ',', '.') ?></td>
              <td><?= 'Rp. ' . number_format($row['harga'] * $row['jumlah'], 0, ',', '.') ?></td>
              <td><?= $row['ex_obat'] ?></td>
              <td><?= $row['nama_suplier'] ?></td>
              <td><?= $row['tgl_jatuh_tempo'] ?></td>
              <td style="text-transform: uppercase;"><?= $row['jenis_pembelian'] ?></td>
              <td>
                <a href="?page=pembeliandetail&id=<?= $row['no_faktur']; ?>" class="btn btn-success btn-sm mr-1">
                  <i class="fa fa-eye"></i> Lihat
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- /.content -->
<?php
include_once "../partials/scriptdatatables.php";
?>
<script>
  $(function() {
    $('a#deletepembelian').click(function(e) {
      e.preventDefault();
      var urlToRedirect = e.currentTarget.getAttribute('href');
      //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
      Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data dengan nomor faktur yang sama akan ikut terhapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Hapus'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = urlToRedirect;
        }
      })
    });
    if ($('div#hasil_delete').length) {
      Swal.fire({
        title: 'Deleted!',
        text: 'Data berhasil dihapus',
        icon: 'success',
        confirmButtonText: 'OK'
      })
    } else if ($('div#hasil_create').length) {
      Swal.fire({
        title: 'Created!',
        text: 'Data berhasil disimpan',
        icon: 'success',
        confirmButtonText: 'OK'
      })
    } else if ($('div#hasil_update').length) {
      Swal.fire({
        title: 'Updated!',
        text: 'Data berhasil diubah',
        icon: 'success',
        confirmButtonText: 'OK'
      })
    }

    $('#mytable').DataTable({
      pagingType: "full_numbers",
      stateSave: true,
      stateDuration: 60,
      scrollX: true,
      scrollCollapse: true,
      select: true,
    });
  });
</script>