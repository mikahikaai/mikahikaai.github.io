<?php
include_once "../partials/cssdatatables.php";
$database = new Database;
$db = $database->getConnection();
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Rekap Penjualan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item active">Rekap Penjualan</li>
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
      <h3 class="card-title font-weight-bold">Data Rekap Penjualan<br>Periode : <?= tanggal_indo($_SESSION['tgl_rekap_awal']->format('Y-m-d')) . " sd " . tanggal_indo($_SESSION['tgl_rekap_akhir']->format('Y-m-d')) ?></h3>
      <a href="report/reportrekappenjualan.php" target="_blank" class="btn btn-warning btn-sm float-right">
        <i class="fa fa-file-pdf"></i> Export PDF
      </a>
    </div>
    <div class="card-body">
      <table id="mytable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>No.</th>
            <th>No Penjualan</th>
            <th>Tanggal Penjualan</th>
            <th>Nama Pembeli</th>
            <th>Nama Obat</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
            <!-- <th style="display: flex;">Opsi</th> -->
          </tr>
        </thead>
        <tbody>
          <?php

          $tgl_rekap_awal = date_format($_SESSION['tgl_rekap_awal'], "Y-m-d H:i:s");
          $tgl_rekap_akhir = date_format($_SESSION['tgl_rekap_akhir'], "Y-m-d H:i:s");

          // var_dump($tgl_rekap_awal);
          // var_dump($tgl_rekap_akhir);
          // die();

          $selectSql = "SELECT * FROM penjualan pj inner join data_pelanggan pg on pj.id_pelanggan = pg.id_pelanggan inner join obat o on pj.id_obat = o.id_obat WHERE (tgl_penjualan BETWEEN ? AND ?) ORDER BY tgl_penjualan ASC";
          $stmt = $db->prepare($selectSql);
          $stmt->bindParam(1, $tgl_rekap_awal);
          $stmt->bindParam(2, $tgl_rekap_akhir);
          $stmt->execute();

          $no = 1;
          $total_penjualan = 0;
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $total_penjualan += $row['jumlah_obat'] * $row['harga_jual'];
          ?>
            <tr>
              <td><?= $no++ ?></td>
              <td style="text-transform: uppercase;"><?= $row['no_penjualan'] ?></td>
              <td><?= $row['tgl_penjualan'] ?></td>
              <td style="text-transform: uppercase;"><?= $row['nama'] ?></td>
              <td style="text-transform: uppercase;"><?= $row['nama_obat'] ?></td>
              <td><?= $row['jumlah_obat'] ?></td>
              <td><?= 'Rp. ' . number_format($row['harga_jual'], 0, ',', '.') ?></td>
              <td><?= 'Rp. ' . number_format($row['harga_jual'] * $row['jumlah_obat'], 0, ',', '.') ?></td>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <td style="font-weight: bolder;" colspan="7" align="center">TOTAL PENJUALAN</td>
            <td style="font-weight: bolder;" align="center"><?= "Rp. " . number_format($total_penjualan, 0, ",", ".") ?></td>
          </tr>
        </tfoot>
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
    $('#mytable').DataTable();
  });
</script>