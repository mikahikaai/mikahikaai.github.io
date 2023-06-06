<?php
$database = new Database;
$db = $database->getConnection();

if (isset($_POST['button_edit'])) {

  $deletesql = "DELETE FROM pembelian WHERE no_faktur=?";
  $stmtdelete = $db->prepare($deletesql);
  $stmtdelete->bindParam(1, $_GET['id']);
  $stmtdelete->execute();
}

$jumlah_data = count($_POST['id_obat']);

for ($i = 0; $i < $jumlah_data; $i++) {
  $insertsql = "INSERT INTO pembelian VALUES (NULL,?,?,?,?,?,?,?,?,?)";
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
  if ($stmt_insert->execute()) {
    $_SESSION['hasil_update'] = true;
    $_SESSION['pesan'] = "Berhasil Mengubah Data";
  } else {
    $_SESSION['hasil_update'] = false;
    $_SESSION['pesan'] = "Gagal Mengubah Data";
  }

  // $stmt_insert->debugDumpParams();
  // die();

}
echo '<meta http-equiv="refresh" content="0;url=?page=pembelianread"/>';
exit;
