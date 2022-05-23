<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/color.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$color = new Color($db);


if (isset($_GET['cid'])) {
  // Instantiate color object
  if($_GET['cid']=='search'){
    // color read query
    $result = $color->read();
  
    // Get row count
    $num = $result->rowCount();
  
    // Check if any color
    if ($num > 0) {
      // Cat array
      $col_arr = array();
      $col_arr['main'] = array();
  
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
  
        $col_item = array(
          'ID' => $ID,
          'Product_Color' => $Product_Color,
          'Color_Code' => $Color_Code
        );
        $result2 = $color->total_item1($ID);
        while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
  
          $product_item = array(
            'total_item' => $total_item
          );
  
          // Push to "data"
          $new_data = array_merge($col_item, $product_item);
          array_push($col_arr['main'], $new_data);
        }
        // Push to "data"
        // array_push($col_arr['data'], $col_item);
      }
  
      // Turn to JSON & output
      echo json_encode($col_arr);
    } else {
      // No color
      echo json_encode(
        array('message' => 'No color Found')
      );
    }
  }else{
    $color->Category_ID = $_GET['cid'];
    // color read query
    $result = $color->read();
  
    // Get row count
    $num = $result->rowCount();
  
    // Check if any color
    if ($num > 0) {
      // Cat array
      $col_arr = array();
      $col_arr['main'] = array();
  
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
  
        $col_item = array(
          'ID' => $ID,
          'Product_Color' => $Product_Color,
          'Color_Code' => $Color_Code
        );
        $result2 = $color->total_item($ID);
        while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
  
          $product_item = array(
            'total_item' => $total_item
          );
  
          // Push to "data"
          $new_data = array_merge($col_item, $product_item);
          array_push($col_arr['main'], $new_data);
        }
        // Push to "data"
        // array_push($col_arr['data'], $col_item);
      }
  
      // Turn to JSON & output
      echo json_encode($col_arr);
    } else {
      // No color
      echo json_encode(
        array('message' => 'No color Found')
      );
    }
  }
  
}else if (isset($_GET['product_id'])) {
  $color->Product_ID = $_GET['product_id'];
  $result = $color->colorby_product();
  $num = $result->rowCount();
  if ($num > 0) {
    $color_arr = array();
    $color_arr['main'] = array();
    $color_item = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $color_item = $Product_Color_ID;
    }
    $data = explode(",", $color_item);
    $color_all = array();
    $color_final = array();
    foreach ($data as $val) {
      $result = $color->read_single($val);
      $num = $result->rowCount();
      if ($num > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          $color_all = array("color" => $Product_Color, "id" => $ID);
          array_push($color_final, $color_all);
        }
      }
    }
    echo json_encode($color_final);
  } else {
    // No color
    echo json_encode(
      array('message' => 'No color Found')
    );
  }
}

