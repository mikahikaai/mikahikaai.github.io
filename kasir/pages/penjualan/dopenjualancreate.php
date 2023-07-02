<?php
$database = new Database;
$db = $database->getConnection();

$no_penjualan_lama = '';
$sql_no_penjualan_lama = "SELECT * FROM penjualan WHERE MONTH(tgl_penjualan) = MONTH(NOW()) AND YEAR(tgl_penjualan) = YEAR(NOW()) ORDER BY no_penjualan DESC LIMIT 1";
$stmt_no_penjualan_lama = $db->prepare($sql_no_penjualan_lama);
$stmt_no_penjualan_lama->execute();
$row_no_penjualan_lama = $stmt_no_penjualan_lama->fetch(PDO::FETCH_ASSOC);
if ($stmt_no_penjualan_lama->rowCount() == 0){
  $no_penjualan_lama = 1;
} else {
  $no_penjualan_lama = $row_no_penjualan_lama['no_penjualan'];
}

$no_penjualan_baru = (int) substr($no_penjualan_lama,-4);

$format_no_penjualan_baru = "PJ/" . substr(date('Y'),-2) . "/" . date('m/') .  str_pad($no_penjualan_baru + 1, 4, "0", STR_PAD_LEFT);

// var_dump($format_no_penjualan_baru);
// die();

$jumlah_data = count($_POST['id_obat']);

for ($i = 0; $i < $jumlah_data; $i++) {
  $insertsql = "INSERT INTO penjualan (id_penjualan, no_penjualan, id_obat, id_pelanggan, tgl_penjualan, jumlah_obat) VALUES (NULL,?,?,?,?,?)";
  $stmt_insert = $db->prepare($insertsql);
  $stmt_insert->bindParam(1, $format_no_penjualan_baru);
  $stmt_insert->bindParam(2, $_POST['id_obat'][$i]);
  $stmt_insert->bindParam(3, $_POST['id_pelanggan']);
  $stmt_insert->bindParam(4, $_POST['tgl_penjualan']);
  $stmt_insert->bindParam(5, $_POST['jumlah_obat'][$i]);
  $stmt_insert->execute();
//   $stmt_insert->debugDumpParams();
//   die();
}

echo '<meta http-equiv="refresh" content="0;url=?page=penjualanread"/>';
exit;
