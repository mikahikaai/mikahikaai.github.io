<?php
session_start();

if (!isset($_SESSION['level'])) {
  echo '<meta http-equiv="refresh" content="0;url=../../logout.php"/>';
  exit;
}
include "../../database/database.php";

date_default_timezone_set("Asia/Kuala_Lumpur");

$database = new Database;
$db = $database->getConnection();

// var_dump($_SESSION['status_kedatangan_obat']);
// die();

$selectsql = 'SELECT * FROM pelayanan p inner join data_pelanggan dp on p.id_pelanggan = dp.id_pelanggan inner join data_dokter dd on p.id_dokter = dd.id_dokter WHERE dp.id_pelanggan = ? ORDER BY tgl_pelayanan ASC';
$stmt = $db->prepare($selectsql);
$stmt->bindParam(1, $_GET['id_pelanggan']);
$stmt->execute();
?>
<style>
  table#content {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    /* table-layout: fixed; */
    width: 100%;
    margin-bottom: 30px;
  }

  table#content th {
    border: 1px solid grey;
    padding: 8px;
    text-align: center;
    width: fit-content;
    background-color: #5a5e5a;
    color: white;

  }

  table#content td {
    border: 1px solid grey;
    padding: 8px;
  }

  table#content tbody tr:nth-child(even) {
    background-color: #e4ede4;
  }

  table#content1 {
    /* width: 100%; */
    border-collapse: collapse;
    margin-bottom: 10px;
  }

  table#content1 tr td:nth-child(n+2) {
    padding-left: 10px;
  }

  table#content1 td {
    /* border: 1px solid black; */
    padding-bottom: 10px;
  }

  table#summary {
    width: 100%;
    border-collapse: collapse;
  }
</style>

<!-- header -->

<table style="width: 100%; margin-bottom: 10px;">
  <tr>
    <td align="center" style="font-weight: bold; padding-bottom: 20px; font-size: x-large;"><u>DATA REKAP PELAYANAN PER PASIEN</u></td>
  </tr>
</table>

<!-- content -->
<table id="content">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama Pelanggan</th>
      <th>Nama Dokter</th>
      <th>Tanggal Pelayanan</th>
      <th>Keluhan Pasien</th>
      <th>Diagnosa</th>
    </tr>
  </thead>
  <tbody>
    <?php

    $no = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
      <tr>
        <td width="3%"><?= $no++ ?></td>
        <td width="10%" style="text-transform: uppercase;"><?= $row['nama'] ?></td>
        <td width="15%" style="text-transform: uppercase;"><?= $row['nama_dokter'] ?></td>
        <td width="10%"><?= $row['tgl_pelayanan'] ?></td>
        <td width="32%" style="text-transform: uppercase;"><?= $row['keluhan_pasien'] ?></td>
        <?php
        if ($row['diagnosa'] == "DIISI OLEH DOKTER") { ?>
          <td width="40%" style="text-transform: uppercase;"></td>
        <?php } else { ?>
          <td width="40%" style="text-transform: uppercase;"><?= $row['diagnosa'] ?></td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>
<!-- end content -->

<!-- summary -->

<table id="summary" style="page-break-inside: avoid;" autosize="1">
  <tr>
    <td width="70%"></td>
    <td align="center">Martapura, <?= tanggal_indo(date('Y-m-d')) ?></td>
  </tr>
  <tr>
    <td width=" 70%"></td>
    <td><br><br><br><br><br><br><br></td>
  </tr>
  <tr>
    <td width="70%"></td>
    <td align="center"><u><b><?= $_SESSION['nama'] ?></b></u></td>
  </tr>
</table>

<!-- end summary -->

<!-- footer -->
<!-- end footer -->

<?php
function tanggal_indo($date, $cetak_hari = false)
{
  $hari = array(
    1 =>    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu',
    'Minggu'
  );

  $bulan = array(
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $split = explode(' ', $date);
  $split_tanggal = explode('-', $split[0]);
  if (count($split) == 1) {
    $tgl_indo = $split_tanggal[2] . ' ' . $bulan[(int)$split_tanggal[1]] . ' ' . $split_tanggal[0];
  } else {
    $split_waktu = explode(':', $split[1]);
    $tgl_indo = $split_tanggal[2] . ' ' . $bulan[(int)$split_tanggal[1]] . ' ' . $split_tanggal[0] . ' ' . $split_waktu[0] . ':' . $split_waktu[1] . ':' . $split_waktu[2];
  }

  if ($cetak_hari) {
    $num = date('N', strtotime($date));
    return $hari[$num] . ', ' . $tgl_indo;
  }
  return $tgl_indo;
}
?>