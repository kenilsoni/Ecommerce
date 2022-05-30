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
if (isset($data->User_ID)) {
  $cart->Cart_ID = $data->ID;
  $cart->User_ID = $data->User_ID;
  $cart->Color_ID = $data->Color_ID;
  $cart->Product_Name = $data->Product_Name;
  $cart->Size_ID = $data->Size_ID;
  $cart->Quantity = $data->Quantity;
  $cart->Product_Image = $data->Product_Image;
  $cart->Product_ID = $data->Product_ID;
  $cart->Unit_Price = $data->Unit_Price;
  $cart->Total_Amount = $data->Total_Amount;
  $qty = $cart->check_quantity($cart->Product_ID);
  $qty_count = $qty->rowCount();
  if ($qty_count > 0) {
    while ($row = $qty->fetch(PDO::FETCH_ASSOC)) {
      $quantity_db = $row['Product_Quantity'];
    }
    if ($quantity_db < $cart->Quantity) {
      echo json_encode(
        array('message' => "limit_reach")
      );
    } else {
      $result = $cart->update_item();
      // Get row count
      $num = $result->rowCount();
      // Check if any categories
      if ($num > 0) {
        echo json_encode(
          array('message' => 'available')
        );
      } else {

        echo json_encode(
          array('message' => false)
        );
      }
    }
  }
}
