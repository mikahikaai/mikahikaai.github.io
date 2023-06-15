<?php
include_once "../partials/cssdatatables.php";
$database = new Database;
$db = $database->getConnection();
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Rekap Pembelian</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item active">Rekap Pembelian</li>
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
      <h3 class="card-title font-weight-bold">Data Rekap Pembelian<br>Periode : <?= tanggal_indo($_SESSION['tgl_rekap_awal']->format('Y-m-d')) . " sd " . tanggal_indo($_SESSION['tgl_rekap_akhir']->format('Y-m-d')) ?></h3>
      <a href="report/reportrekappembelian.php" target="_blank" class="btn btn-warning btn-sm float-right">
        <i class="fa fa-file-pdf"></i> Export PDF
      </a>
    </div>
    <div class="card-body">
      <table id="mytable" class="table table-bordered table-hover">
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

          $selectSql = "SELECT * FROM pembelian p inner join obat o on p.id_obat = o.id_obat inner join suplier s on p.id_suplier = s.id_suplier WHERE (tgl_pembelian BETWEEN ? AND ?) ORDER BY tgl_pembelian ASC";
          $stmt = $db->prepare($selectSql);
          $stmt->bindParam(1, $tgl_rekap_awal);
          $stmt->bindParam(2, $tgl_rekap_akhir);
          $stmt->execute();

          $no = 1;
          $total_pembelian = 0;
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $total_pembelian += $row['jumlah'] * $row['harga'];
          ?>
            <tr>
              <td><?= $no++ ?></td>
              <td style="text-transform: uppercase;"><?= $row['no_faktur'] ?></td>
              <td><?= tanggal_indo($row['tgl_pembelian']) ?></td>
              <td style="text-transform: uppercase;"><?= $row['nama_obat'] ?></td>
              <td><?= number_format($row['jumlah'], 0, ",", ".") ?></td>
              <td><?= "Rp. " . number_format($row['harga'], 0, ",", ".") ?></td>
              <td><?= "Rp. " . number_format($row['jumlah'] * $row['harga'], 0, ",", ".") ?></td>
              <td><?= tanggal_indo($row['ex_obat']) ?></td>
              <td><?= $row['nama_suplier'] ?></td>
              <td><?= tanggal_indo($row['tgl_jatuh_tempo']) ?></td>
              <td style="text-transform: uppercase;"><?= $row['jenis_pembelian'] ?></td>
            </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <td style="font-weight: bolder;" colspan="6" align="center">TOTAL PEMBELIAN</td>
            <td style="font-weight: bolder;" colspan="6" align="center"><?= "Rp. " . number_format($total_pembelian, 0, ",", ".") ?></td>
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