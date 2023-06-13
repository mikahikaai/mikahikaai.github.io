<?php
$database = new Database;
$db = $database->getConnection();

if (isset($_POST['button_edit'])) {

  $deletesql = "DELETE FROM penjualan WHERE no_penjualan=?";
  $stmtdelete = $db->prepare($deletesql);
  $stmtdelete->bindParam(1, $_GET['id']);
  $stmtdelete->execute();
}

$jumlah_data = count($_POST['id_obat']);

for ($i = 0; $i < $jumlah_data; $i++) {
  $insertsql = "INSERT INTO penjualan VALUES (NULL,?,?,?,?,?)";
  $stmt_insert = $db->prepare($insertsql);
  $stmt_insert->bindParam(1, $_GET['id']);
  $stmt_insert->bindParam(2, $_POST['id_obat'][$i]);
  $stmt_insert->bindParam(3, $_POST['id_pelanggan']);
  $stmt_insert->bindParam(4, $_POST['tgl_penjualan']);
  $stmt_insert->bindParam(5, $_POST['jumlah_obat'][$i]);
  if ($stmt_insert->execute()) {
    $_SESSION['hasil_update'] = true;
    $_SESSION['pesan'] = "Berhasil Mengubah Data";
  } else {
    $_SESSION['hasil_update'] = false;
    $_SESSION['pesan'] = "Gagal Mengubah Data";
  }

  updateStok();
  // $stmt_insert->debugDumpParams();
  // die();

}
echo '<meta http-equiv="refresh" content="0;url=?page=penjualanread"/>';
exit;
