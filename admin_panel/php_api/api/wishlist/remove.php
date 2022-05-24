<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: *');
include_once '../../config/Database.php';
include_once '../../models/wishlist.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
// Instantiate wishlist object
$wishlist = new Wishlist($db);
if (isset($_GET['user_id']) && isset($_GET['product_id'])) {
  $result = $wishlist->remove_item($_GET['user_id'], $_GET['product_id']);
}
// Check if any categories
if ($result) {
  echo json_encode(
    array('message' => true)
  );
} else {
  echo json_encode(
    array('message' => false)
  );
}
