<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/product.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate product object
$product = new Product($db);

// Get ID
$product->ID = isset($_GET['id']) ? $_GET['id'] : die();


// product read query
$result = $product->read_single();
$result2 = $product->getall_images();

// Get row count
$num = $result->rowCount();

// Check if any product
if ($num > 0) {
  // product array
  $product_arr = array();
  $product_arr['data'] = array();
  $product_arr['img'] = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $product_item = array(
      'ID' => $ID,
      'Product_Name' => $Product_Name,
      'Product_Description' => $Product_Description,
      'Product_Quantity' => $Product_Quantity,
      'IsTrending' => $IsTrending,
      'Subcategory_ID' => $Subcategory_ID,
      'Category_ID' => $Category_ID,
      'Product_Quantity' => $Product_Quantity,
      'Product_Color_ID' => $Product_Color_ID,
      'Product_Size' => $Product_Size,
      'Product_Price' => $Product_Price,
      'Category_name' => $Category_Name,
      'Subcategory_name' => $Subcategory_Name,
      'Size_Name' => $Product_Size,
      'Color_name' => $Product_Color,
      'Image_path' => $Image_Path
    );

    // Push to "data"
    array_push($product_arr['data'], $product_item);
  }
  while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $product_item2 = array(
      'all_img' => $Image_Path
    );
    array_push($product_arr['img'], $product_item2);
  }

  // Turn to JSON & output

  echo json_encode($product_arr);
} else {
  // No product
  echo json_encode(
    array('message' => 'No product Found')
  );
}
