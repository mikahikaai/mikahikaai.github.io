<?php

function updateStok()
{

  $database = new Database;
  $db = $database->getConnection();

  $selectsqlstok = "SELECT id_obat FROM obat";
  $stmtstokobat = $db->prepare($selectsqlstok);
  $stmtstokobat->execute();

  while ($rowstokobat = $stmtstokobat->fetch(PDO::FETCH_ASSOC)) {

    $jumlah_beli_obat = 0;
    $selectpembelian = "SELECT SUM(jumlah) FROM pembelian WHERE id_obat = ?";
    $stmt_pembelian = $db->prepare($selectpembelian);
    $stmt_pembelian->bindParam(1, $rowstokobat['id_obat']);
    $stmt_pembelian->execute();

    $row_beli_obat = $stmt_pembelian->fetch(PDO::FETCH_ASSOC);
    $jumlah_beli_obat = $row_beli_obat['jumlah'];

    $jumlah_jual_obat = 0;
    $selectpenjualan = "SELECT SUM(jumlah_obat) FROM penjualan WHERE id_obat = ?";
    $stmt_penjualan = $db->prepare($selectpenjualan);
    $stmt_penjualan->bindParam(1, $rowstokobat['id_obat']);
    $stmt_penjualan->execute();

    $row_jual_obat = $stmt_penjualan->fetch(PDO::FETCH_ASSOC);
    $jumlah_jual_obat = $row_jual_obat['jumlah_obat'];

    $jumlah_stok_obat = $jumlah_beli_obat - $jumlah_jual_obat;

    $updatestokobat = "UPDATE obat SET stok_obat = ? WHERE id_obat = ?";
    $stmt_updatestokobat = $db->prepare($updatestokobat);
    $stmt_updatestokobat->bindParam(1, $jumlah_stok_obat);
    $stmt_updatestokobat->bindParam(2, $rowstokobat['id_obat']);
    $stmt_updatestokobat->execute();
  }
}
