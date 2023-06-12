<?php

include '../../../database/database.php';

$database = new Database;
$db = $database->getConnection();

$query = "SELECT harga_jual, stok_obat FROM obat WHERE id_obat=?";
$stmt = $db->prepare($query);
$stmt->bindParam(1, $_GET['id']);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

$data = [];
  $data[] = $result['harga_jual'];
  $data[] = $result['stok_obat'];

echo json_encode($data);