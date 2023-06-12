<?php
$database = new Database;
$db = $database->getConnection();

$jumlah_data = count($_POST['id_obat']);

for ($i = 0; $i < $jumlah_data; $i++) {
  $insertsql = "INSERT INTO pembelian (id_pembelian, id_obat, id_suplier, tgl_pembelian, tgl_jatuh_tempo, jumlah, no_faktur, ex_obat, harga, jenis_pembelian) VALUES (NULL,?,?,?,?,?,?,?,?,?)";
  $stmt_insert = $db->prepare($insertsql);
  $stmt_insert->bindParam(1, $_POST['id_obat'][$i]);
  $stmt_insert->bindParam(2, $_POST['id_suplier']);
  $stmt_insert->bindParam(3, $_POST['tgl_pembelian']);
  $stmt_insert->bindParam(4, $_POST['tgl_jatuh_tempo']);
  $stmt_insert->bindParam(5, $_POST['jumlah'][$i]);
  $stmt_insert->bindParam(6, $_POST['no_faktur']);
  $stmt_insert->bindParam(7, $_POST['ex_obat'][$i]);
  $stmt_insert->bindParam(8, $_POST['harga'][$i]);
  $stmt_insert->bindParam(9, $_POST['jenis_pembelian']);
  $stmt_insert->execute();
  //   $stmt_insert->debugDumpParams();
  //   die();

  $updatesql = "UPDATE obat SET stok_obat = stok_obat + ? WHERE id_obat =?";
  $stmt_update = $db->prepare($updatesql);
  $stmt_update->bindParam(1, $_POST['jumlah'][$i]);
  $stmt_update->bindParam(2, $_POST['id_obat'][$i]);
  $stmt_update->execute();
}

echo '<meta http-equiv="refresh" content="0;url=?page=pembelianread"/>';
exit;
