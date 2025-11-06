<?php
require_once('Connections/conn_db.php');
if (!isset($_SESSION)) session_start();
header('Content-Type: application/json');

// Get shipping id
$shipping_id = intval($_POST['shipping_id'] ?? 0);
$ip = $_SERVER['REMOTE_ADDR'];

if ($shipping_id <= 0) {
  echo json_encode(['success' => false, 'message' => '無效的運送方式']);
  exit;
}

// Check shipping method validity
$sql = "SELECT shipping_name FROM shipping_method WHERE shipping_id=?";
$stmt = $link->prepare($sql);
$stmt->execute([$shipping_id]);
$ship = $stmt->fetch();

if (!$ship) {
  echo json_encode(['success' => false, 'message' => '找不到此運送方式']);
  exit;
}

// Update cart shipping_id for current session/IP
$updateSQL = "UPDATE cart SET shipping_id=? WHERE ip=? AND orderid IS NULL";
$stmt2 = $link->prepare($updateSQL);
$stmt2->execute([$shipping_id, $ip]);

echo json_encode(['success' => true, 'name' => $ship['shipping_name']]);

?>