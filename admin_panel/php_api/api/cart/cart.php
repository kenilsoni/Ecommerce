<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: *");
include_once '../../config/Database.php';
include_once '../../models/cart.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
// Instantiate cart object
$cart = new Cart($db);
$data = json_decode(file_get_contents("php://input"));
if (isset($_GET['user_id'])) {
  $cart->User_ID = $_GET['user_id'];
  $result = $cart->getcart_items();
}
// Get row count
$num = $result->rowCount();
// Check if any categories
if ($num > 0) {
  // Cat array
  $Cart_arr = array();
  $Cart_arr['data'] = array();
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $cart_item = array(
      'ID' => $ID,
      'Product_ID' => $Product_ID,
      'Product_Name' => $Product_Name,
      'Quantity' => $Quantity,
      'Color_ID' => $Color_ID,
      'Size_ID' => $Size_ID,
      'Total_Amount' => $Total_Amount,
      'Unit_Price' => $Unit_Price,
      'User_ID' => $User_ID,
      'Color_Name' => $Product_Color,
      'Size_Name' => $Product_Size,
      'Product_Image' => $Product_Image,
      'currency' => ''
    );
    // Push to "data"
    array_push($Cart_arr['data'], $cart_item);
  }
  // Turn to JSON & output
  echo json_encode($Cart_arr);
} else {
  // No Categories
  echo json_encode(
    array('data' => false)
  );
}
