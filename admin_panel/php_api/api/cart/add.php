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
$data = json_decode(file_get_contents("php://input"));
if (isset($data->user_id)) {
  $cart->User_ID = $data->user_id;
  $cart->Color_ID = $data->Product_Color_ID;
  $cart->Product_Name = $data->Product_Name;
  $cart->Size_ID = $data->Size_id;
  $cart->Quantity = $data->Product_Quantity;
  $cart->Product_Image = $data->Image_path;
  $cart->Product_ID = $data->ID;
  $cart->Unit_Price = $data->Product_Price;
  $cart->Total_Amount = $data->Product_Price;
  $check = $cart->check_item();
  $count = $check->rowCount();
  if ($count > 0) {
    while ($row = $check->fetch(PDO::FETCH_ASSOC)) {
      // extract($row);
      $quantity = $row['Quantity'];
      $unit_price = $row['Unit_Price'];
    }
    $quantity += 1;
    $total = $quantity * $unit_price;
    $result = $cart->update_quantity($quantity, $total);
  } else {
    $result = $cart->add_item();
  }
}
// Get row count
$num = $result->rowCount();
// Check if any categories
if ($num > 0) {
  echo json_encode(
    array('message' => true)
  );
} else {

  echo json_encode(
    array('message' => false)
  );
}
