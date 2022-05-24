<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: *');
include_once '../../config/Database.php';
include_once '../../models/cart.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
// Instantiate cart object
$cart = new Cart($db);
if (isset($_GET['id'])) {
  $cart->Cart_ID = $_GET['id'];
  // print_r($cart);die();
  $result = $cart->remove_item();
} else if (isset($_GET['user_id'])) {
  $cart->User_ID = $_GET['user_id'];
  // print_r($cart);die();
  $result = $cart->remove_all_item();
}
// Get row count
$num = $result->rowCount();
if ($num > 0) {
  echo json_encode(
    array('message' => true)
  );
} else {
  echo json_encode(
    array('message' => false)
  );
}
